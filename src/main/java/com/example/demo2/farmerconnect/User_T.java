package com.example.demo2.farmerconnect;


import jakarta.persistence.Entity;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

import java.sql.Date;

@Data

@NoArgsConstructor
@AllArgsConstructor

public class User_T {

    // Attributes from TARGET_USER_T
    private int userID; // Primary Key from TARGET_USER_T
    private String userName;
    private int phoneNumber; // Assuming it stores 10-digit phone numbers
    private String areaCode;
    private String userType; // Should always be "Farmer" for Farmer records
    private Date dateOfRegistration;
    private String shopNumber = null;
    private String cropID = null;
    // Attributes from FARMER_T

    private String educationLevel = null;

    // handle Target USer Specifically
    public User_T(int phoneNumber, int userID, String userName, String userType, Date dateOfRegistration, String areaCode) {
        this.phoneNumber = phoneNumber;
        this.userID = userID;
        this.userName = userName;
        this.userType = userType;
        this.dateOfRegistration = dateOfRegistration;
        this.areaCode = areaCode;
    }
    // handling Agent user insertion


    public User_T(String areaCode, String cropID, String educationLevel, int phoneNumber, String shopNumber, String userName, String userType) {
        this.areaCode = areaCode;
        this.cropID = cropID;
        this.educationLevel = educationLevel;
        this.phoneNumber = phoneNumber;
        this.shopNumber = shopNumber;
        this.userName = userName;
        this.userType = userType;
    }


    ///     for buyer fetching for bid  ........
    public User_T(int userID, String userName, int phoneNumber) {
        this.userID = userID;
        this.userName = userName;
        this.phoneNumber = phoneNumber;
    }
}
