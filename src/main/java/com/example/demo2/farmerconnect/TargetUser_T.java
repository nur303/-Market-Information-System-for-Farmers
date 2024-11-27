package com.example.demo2.farmerconnect;

import jakarta.persistence.*;
import lombok.Data;
import lombok.Getter;
import lombok.Setter;

import java.util.Date;
@Data
@Entity
@Table(
        name = "TARGET_USER_T"
)
public class TargetUser_T {

        @Id
        @GeneratedValue(
                strategy = GenerationType.IDENTITY
        )

        private String userID;
        private String userName;
        private String areaCode ;
        private int phoneNumber;
        private Date dateOfRegistration;
        private String userType;

        public TargetUser_T(String area_code, int phone_number, String userID, String userName, String userType) {
            this.areaCode = area_code;
            this.phoneNumber = phone_number;
            this.userID = userID;
            this.userName = userName;
            this.userType = userType;
        }

        public TargetUser_T(int phone_number, String area_code, String userName, String userType) {

            this.phoneNumber = phone_number;
            this.areaCode = area_code;
            this.userName = userName;
            this.userType = userType;
        }

        public TargetUser_T() {
        }


}


