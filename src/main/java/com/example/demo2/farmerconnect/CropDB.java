package com.example.demo2.farmerconnect;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

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
        String sql = "insert  INTO CROP_T (cropID,crop_name,season) VALUES(?,?,?)";

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
    public List<Crop_T> showAllCropData() {
        List<Crop_T> allCropData = new ArrayList<>();
        String sql = "SELECT  cropid,crop_name,season FROM CROP_T";
        try {
            PreparedStatement ps = conn.prepareStatement(sql);
            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                Crop_T cropData = new Crop_T();

                // Assuming update_date is of type java.sql.Date
                cropData.setCropID(rs.getString(1));  // Use getUpdate_date for update_date fields
                cropData.setCrop_name(rs.getString(2));  // Set Crop ID
                cropData.setSeason(rs.getString(3));  // Set Area Code

                allCropData.add(cropData);
            }
            rs.close();
            ps.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return allCropData;
    }

    public boolean deleteData(String bigData ) {
        String sql = "DELETE FROM CROP_T WHERE  cropid = ?";
        try {
            PreparedStatement ps = conn.prepareStatement(sql);
            ps.setString(1, bigData);
            int affectedRows = ps.executeUpdate();
            ps.close();
            return affectedRows > 0; // Returns true if a row was deleted
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }
}
