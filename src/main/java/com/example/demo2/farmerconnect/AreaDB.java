package com.example.demo2.farmerconnect;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;

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
            PreparedStatement ps = conn.prepareStatement(sql);
            ps.setString(1, bigData.getArea_code());
            ps.setString(2, bigData.getArea_location());
            ps.execute();
        } catch (SQLException e) {
            throw new RuntimeException(e);
        }

    }
}
