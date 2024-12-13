package com.example.demo2.farmerconnect;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class AreaDB {
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
    public void save_area_data(Area_T bigData ){

        String sql = "insert  INTO AREA_T (area_code,area_location) VALUES(?,?)";

        try {
            System.out.println(bigData.getArea_location()+ "from DB");
            PreparedStatement ps = conn.prepareStatement(sql);
            ps.setString(1, bigData.getArea_code());
            ps.setString(2, bigData.getArea_location());
            ps.execute();
        } catch (SQLException e) {
            throw new RuntimeException(e);
        }

    }
    public List<Area_T> showAllAreaData() {
        List<Area_T> allData = new ArrayList<>();
        String sql = "SELECT  area_code,area_location FROM AREA_T";
        try {
            PreparedStatement ps = conn.prepareStatement(sql);
            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                Area_T areaData = new Area_T();

                // Assuming update_date is of type java.sql.Date
                areaData.setArea_code(rs.getString(1));  // Use getUpdate_date for update_date fields
                areaData.setArea_location(rs.getString(2));  // Set Crop ID
                allData.add(areaData);
            }
            rs.close();
            ps.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return allData;
    }
}
