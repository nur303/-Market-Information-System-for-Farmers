package com.example.demo2.farmerconnect;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;

public class AgentDB {
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
}
