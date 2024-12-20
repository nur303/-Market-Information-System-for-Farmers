package com.example.demo2.farmerconnect;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import lombok.Data;

@Data

public class Crop_T {

        private String cropID;
        private String crop_name;
        private String season;

        public Crop_T(String cropID, String crop_name, String season) {
            this.cropID = this.cropID;
            this.crop_name = crop_name;
            this.season = season;
        }

        public Crop_T() {

        }
    }


