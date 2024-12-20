package com.example.demo2.farmerconnect;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class HarvestDB {
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

    public void save_harvest_data(Harvest_T bigData ){
        String sql = "insert  INTO HARVEST_T (askingPrice,farmerID,cropID,inStock, quantity_in_KG,quality,area_code) VALUES(?,?,?,?,?,?,?)";

        try {
            PreparedStatement ps = conn.prepareStatement(sql);

            ps.setInt(1, bigData.getAskingPrice());
            ps.setInt(2, bigData.getFarmerID());
            ps.setString(3, bigData.getCropID());
            ps.setInt(4,bigData.getInStock());
            ps.setInt(5, bigData.getQuantity());
            ps.setString(6,bigData.getQuality());
            ps.setString(7,bigData.getArea_code());


            ps.execute();
        } catch (SQLException e) {
            throw new RuntimeException(e);
        }
    }

    public List<Harvest_T> get_all_harvest_data(){
        List<Harvest_T> list = new ArrayList();
        String sql = "SELECT h.harvestId,h.update_date,h.farmerID,tu.user_name AS farmer_name,  c.cropID,c.crop_name, h.area_code,a.area_location, h.inStock,h.quantity_in_KG,h.quality, h.askingPrice FROM Harvest_T h LEFT JOIN Target_User_T tu ON h.farmerID = tu.userID  LEFT JOIN Crop_T c ON h.cropID = c.cropID LEFT JOIN Area_T a ON h.area_code = a.area_code";
        try{
            PreparedStatement ps = conn.prepareStatement(sql);
            ResultSet rs = ps.executeQuery();
            while(rs.next()){
                Harvest_T bigData = new Harvest_T();
                bigData.setHarvestId(rs.getInt("harvestID"));
                bigData.setAskingPrice(rs.getInt("askingPrice"));
                bigData.setFarmerName(rs.getString("farmer_name"));
                bigData.setCropName(rs.getString("crop_name"));
                bigData.setInStock(rs.getInt("inStock"));
                bigData.setQuantity(rs.getInt("quantity_in_KG"));
                bigData.setQuality(rs.getString("quality"));
                bigData.setLocation(rs.getString("area_location"));
                bigData.setUpdate_date(rs.getDate("update_date"));
                list.add(bigData);

            }
            return list;
        }catch (SQLException ex){
            throw new RuntimeException(ex);

        }

    }

    public boolean deleteData(int bigData ) {


        String sql = "DELETE FROM HARVEST_T WHERE harvestid = ? ";
        try {
            PreparedStatement ps = conn.prepareStatement(sql);

            // Set primary key parameters
            ps.setInt(1, bigData);
            int affectedRows = ps.executeUpdate();
            ps.close();
            return affectedRows > 0; // Returns true if a row was deleted
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

}
