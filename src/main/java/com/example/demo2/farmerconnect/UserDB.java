package com.example.demo2.farmerconnect;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class UserDB {
    User_T user = new User_T();

    Connection conn;

    {  // runs when an instance is created..
        try {
            conn = DriverManager.getConnection("jdbc:postgresql://localhost:5432/FarmerConnect_Group23",
                    "postgres",
                    "12345");
        } catch (
                SQLException ex) {
            throw new RuntimeException(ex);
        }
    }

    public void save_user_in_targetUSer(User_T bigData) {
        String sql = "INSERT INTO TARGET_USER_T(user_name,phone_number,area_code,user_type) values(?,?,?,?)";

        String sql2 = "INSERT INTO FARMER_T(farmerID,education_level) values(?,?)";

        String sql3 = "INSERT INTO BUYER_T (buyerID,shopNumber,prefered_cropsID ) VALUES (?,?,?)";

        try {
            PreparedStatement ps = conn.prepareStatement(sql);
            PreparedStatement ps2 = conn.prepareStatement(sql2);
            PreparedStatement ps3 = conn.prepareStatement(sql3);

            ps.setString(1, bigData.getUserName());
            ps.setInt(2, bigData.getPhoneNumber());
            ps.setString(3, bigData.getAreaCode());
            ps.setString(4, bigData.getUserType());
            ps.execute();
            if (bigData.getUserType().equals("Farmer")) {
                int farmerID = save_farmer_user();
                ps2.setInt(1, farmerID);
                ps2.setString(2, bigData.getEducationLevel());
                ps2.execute();
            }
            if (bigData.getUserType().equals("Buyer")) {
                int buyerID = save_buyer_user();
                ps3.setInt(1, buyerID);
                ps3.setString(2, bigData.getShopNumber());
                ps3.setString(3, bigData.getCropID());
                ps3.execute();
            }


        } catch (SQLException e) {
            throw new RuntimeException(e);
        }

    }

    public int save_farmer_user() {
        String sql2 = "SELECT u.userID FROM TARGET_USER_T AS u LEFT JOIN FARMER_T AS f ON u.userID = f.farmerID WHERE u.user_type = 'Farmer' AND f.farmerID IS NULL";
        try {
            PreparedStatement ps2 = conn.prepareStatement(sql2);
            ResultSet rs = ps2.executeQuery();
            while (rs.next()){
                user.setUserID(rs.getInt(1));
            }

        } catch (SQLException ex) {
            throw new RuntimeException(ex);
        }
        return user.getUserID();


    }

    public int save_buyer_user() {
        String sql2 = "SELECT u.userID FROM TARGET_USER_T AS u LEFT JOIN BUYER_T AS f ON u.userID = f.buyerID WHERE u.user_type = 'Buyer' AND f.buyerID IS NULL";
        try {
            PreparedStatement ps2 = conn.prepareStatement(sql2);
            ResultSet rs = ps2.executeQuery();
            while (rs.next()){
                user.setUserID(rs.getInt(1));
            }

        } catch (SQLException ex) {
            throw new RuntimeException(ex);
        }
        return user.getUserID();


    }

    public List<User_T> showAllFarmerData() {
        List<User_T> allDataList = new ArrayList<>();
        String sql = "SELECT farmerID FROM FARMER_T";
        try (PreparedStatement ps = conn.prepareStatement(sql);
             ResultSet rs = ps.executeQuery()) {
            while (rs.next()) {
                User_T user = new User_T(); // Instantiate the User_T object
                user.setUserID(rs.getInt("farmerID")); // Set the farmerID
                allDataList.add(user); // Add the user to the list
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return allDataList;
    }
    public List<User_T> showAllUserData() {
        List<User_T> allDataList = new ArrayList<>();
        String sql = "SELECT userID,user_name,phone_umber FROM TARGET_USER_T";
        try (PreparedStatement ps = conn.prepareStatement(sql);
             ResultSet rs = ps.executeQuery()) {
            while (rs.next()) {
                User_T user = new User_T(); // Instantiate the User_T object
                user.setUserID(rs.getInt("userID"));
                user.setUserName(rs.getString("user_name"));
                user.setPhoneNumber(rs.getInt("phone_number"));// Set the farmerID
                allDataList.add(user); // Add the user to the list
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return allDataList;
    }
}
