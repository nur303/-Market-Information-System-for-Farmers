package com.example.demo2.farmerconnect;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;

public class CropDB {
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
    public void save_crop_data(Crop_T bigData ){
        String sql = "insert  INTO AREA_T (cropID,crop_name,season) VALUES(?,?,?)";

        try {
            PreparedStatement ps = conn.prepareStatement(sql);
            ps.setString(1, bigData.getCropID());
            ps.setString(2, bigData.getCrop_name());
            ps.setString(3, bigData.getSeason());
            ps.execute();
        } catch (SQLException e) {
            throw new RuntimeException(e);
        }

    }
}
