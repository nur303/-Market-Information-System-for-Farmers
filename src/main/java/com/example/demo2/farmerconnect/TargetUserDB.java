package com.example.demo2.farmerconnect;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class TargetUserDB {
    Connection conn = null;
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

    public void save_targetUser(TargetUser_T targetUser) {
        String sql = "insert  INTO TARGET_USER_T(userid,area_code,phone_number,user_type,user_name) VALUES(?,?,?,?,?)";

        try {
            PreparedStatement ps = conn.prepareStatement(sql);


            ps.setString(1, targetUser.getUserID());
            ps.setString(2, targetUser.getAreaCode());
            ps.setInt(3, targetUser.getPhoneNumber());
            ps.setString(4,targetUser.getUserType());
            ps.setString(5, targetUser.getUserName());

            ps.execute();
        } catch (SQLException e) {
            throw new RuntimeException(e);
        }

    }
    public List<TargetUser_T> getAllTargetUser() {
       List<TargetUser_T> userList = new ArrayList<TargetUser_T>();
       String sql = "Select userID,user_name,area_code,phone_number,user_type  FROM TARGET_USER_T";

        try {
            PreparedStatement ps = conn.prepareStatement(sql);
            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                TargetUser_T targetUser = new TargetUser_T();
                targetUser.setUserID(rs.getString(1));
                targetUser.setUserName(rs.getString(2));
                targetUser.setAreaCode(rs.getString(3));
                targetUser.setPhoneNumber(rs.getInt(4));
                targetUser.setUserType(rs.getString(5));
                userList.add(targetUser);

            }
        } catch (SQLException e) {
            throw new RuntimeException(e);
        }
        return userList;
    }
}
