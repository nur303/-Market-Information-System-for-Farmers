package com.example.demo2.farmerconnect;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class AnalystDB {
    Connection conn ;
    {  // runs when an instance is created..
        try

        {
            conn = DriverManager.getConnection("jdbc:postgresql://localhost:5432/FarmerConnect_Group23",
                    "postgres",
                    "12345");
        } catch(
                SQLException ex)

        {
            throw new RuntimeException(ex);
        }
    }


    public List<AnalystMarketPriceAndAdvisedRates_T> showAllMarketData() {
        List<AnalystMarketPriceAndAdvisedRates_T> allMarketData = new ArrayList<>();
        String sql = "SELECT mp.update_date,mp.cropid,mp.area_code, mp.reason_for_advised_rate, mp.expected_price_after_week_tk_per_kg, mp.highest_price_per_kg_or_unit, mp.lowest_price_per_kg_or_unit, mp.current_demand_status, mp.current_supply_status , c.crop_name, a.area_location FROM MARKET_PRICE_FOR_CROPS_AND_ADVISED_RATES_T mp JOIN Area_T a ON mp.area_code = a.area_code JOIN Crop_T c ON mp.cropid = c.cropid";
        try {
            PreparedStatement ps = conn.prepareStatement(sql);
            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                AnalystMarketPriceAndAdvisedRates_T marketData = new AnalystMarketPriceAndAdvisedRates_T();

                // Assuming update_date is of type java.sql.Date
                marketData.setUpdateDate(rs.getDate(1));  // Use getUpdate_date for update_date fields
                marketData.setCropID(rs.getString(2));  // Set Crop ID
                marketData.setAreaCode(rs.getString(3));  // Set Area Code
                marketData.setReason_for_advised_rate(rs.getString(4));  // Set Reason for Advised Rate
                marketData.setExpected_price_after_week_tk_per_kg(rs.getInt(5));  // Set Expected Price
                marketData.setHighestPricePerKgOrUnit(rs.getInt(6));  // Set Highest Price
                marketData.setLowestPricePerKgOrUnit(rs.getInt(7));  // Set Lowest Price
                marketData.setCurrent_demand_status(rs.getString(8));  // Set Current Demand Status
                marketData.setCurrent_supply_status(rs.getString(9));  // Set Current Supply Status
                marketData.setCropName(rs.getString(10));
                marketData.setArea_location(rs.getString(11));
                allMarketData.add(marketData);
            }
            rs.close();
            ps.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return allMarketData;
    }

    public void save_market_data(AnalystMarketPriceAndAdvisedRates_T bigData ){
        String sql = "insert  INTO MARKET_PRICE_FOR_CROPS_AND_ADVISED_RATES_T (cropid,area_code,reason_for_advised_rate,expected_price_after_week_tk_per_kg,highest_price_per_kg_or_unit,lowest_price_per_kg_or_unit,current_demand_status,current_supply_status) VALUES(?,?,?,?,?,?,?,?)";

        try {
            PreparedStatement ps = conn.prepareStatement(sql);


            ps.setString(1, bigData.getCropID());
            ps.setString(2, bigData.getAreaCode());
            ps.setString(3, bigData.getReason_for_advised_rate());
            ps.setInt(4,bigData.getExpected_price_after_week_tk_per_kg());
            ps.setInt(5, bigData.getHighestPricePerKgOrUnit());
            ps.setInt(6,bigData.getLowestPricePerKgOrUnit());
            ps.setString(7,bigData.getCurrent_demand_status());
            ps.setString(8,bigData.getCurrent_supply_status());

            ps.execute();
        } catch (SQLException e) {
            throw new RuntimeException(e);
        }
    }
    public boolean deleteData(AnalystMarketPriceAndAdvisedRates_T bigData ) {
        Date updateDate = bigData.getUpdateDate();
        String cropID = bigData.getCropID();
        String areaCode = bigData.getAreaCode();
        String sql = "DELETE FROM MARKET_PRICE_FOR_CROPS_AND_ADVISED_RATES_T WHERE update_date = ? AND cropid = ? AND area_code = ?";
        try {
            PreparedStatement ps = conn.prepareStatement(sql);

            // Set primary key parameters
            ps.setDate(1, updateDate);
            ps.setString(2, cropID);
            ps.setString(3, areaCode);

            int affectedRows = ps.executeUpdate();
            ps.close();
            return affectedRows > 0; // Returns true if a row was deleted
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }
    public boolean updateData(AnalystMarketPriceAndAdvisedRates_T updatedData) {
        String sql = "UPDATE MARKET_PRICE_FOR_CROPS_AND_ADVISED_RATES_T " +
                "SET highest_price_per_kg_or_unit = ?, lowest_price_per_kg_or_unit = ?, expected_price_after_week_tk_per_kg = ?, " +
                "reason_for_advised_rate = ?, current_demand_status = ?, current_supply_status = ? " +
                "WHERE update_date = ? AND cropID = ? AND area_code = ?";

        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, updatedData.getHighestPricePerKgOrUnit());
            ps.setInt(2, updatedData.getLowestPricePerKgOrUnit());
            ps.setInt(3, updatedData.getExpected_price_after_week_tk_per_kg());
            ps.setString(4, updatedData.getReason_for_advised_rate());
            ps.setString(5, updatedData.getCurrent_demand_status());
            ps.setString(6, updatedData.getCurrent_supply_status());
            ps.setDate(7, updatedData.getUpdateDate());
            ps.setString(8, updatedData.getCropID());
            ps.setString(9, updatedData.getAreaCode());

            int rowsAffected = ps.executeUpdate();
            return rowsAffected > 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }







}
