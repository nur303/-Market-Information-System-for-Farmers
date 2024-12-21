package com.example.demo2.farmerconnect;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import lombok.Data;

@Data

public class Area_T {

    private String area_code;
    private String area_location;

    public Area_T(String area_code, String area_location) {
        this.area_code = area_code;
        this.area_location = area_location;
    }

    public Area_T() {

    }
}