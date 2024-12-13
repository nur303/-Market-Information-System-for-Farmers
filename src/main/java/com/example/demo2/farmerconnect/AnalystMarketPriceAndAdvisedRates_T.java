package com.example.demo2.farmerconnect;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import lombok.Data;

import java.sql.Date;

@Data
@Entity
@Table(name = "MARKET_PRICE_FOR_CROPS_AND_ADVISED_RATES_T")

public class AnalystMarketPriceAndAdvisedRates_T {

    @Id
    private Date updateDate;
    @Id
    private String cropID;
    private String cropName = null;

    @Id
    private String areaCode;
    private String area_location = null;
    private String reason_for_advised_rate;
    private String current_demand_status;
    private String current_supply_status;
    private Integer highestPricePerKgOrUnit;
    private Integer lowestPricePerKgOrUnit;
    private Integer expected_price_after_week_tk_per_kg;


    public AnalystMarketPriceAndAdvisedRates_T(String areaCode, String cropID, String current_demand_status, String current_supply_status,Integer expected_sales_price_after_week,Integer highestPricePerKgOrUnit, Integer lowestPricePerKgOrUnit, String reason_for_advised_rate) {
        this.areaCode = areaCode;
        this.cropID = cropID;
        this.current_demand_status = current_demand_status;
        this.current_supply_status = current_supply_status;
        this.highestPricePerKgOrUnit = highestPricePerKgOrUnit;
        this.lowestPricePerKgOrUnit = lowestPricePerKgOrUnit;
        this.reason_for_advised_rate = reason_for_advised_rate;
        this.expected_price_after_week_tk_per_kg = expected_sales_price_after_week;
    }


    public AnalystMarketPriceAndAdvisedRates_T() {

    }

    public AnalystMarketPriceAndAdvisedRates_T(Date update_date, String cropID, String areaCode) {
        this.updateDate = update_date;
        this.cropID = cropID;
        this.areaCode = areaCode;
    }

    public AnalystMarketPriceAndAdvisedRates_T(String areaCode, String cropID, String cropName, String current_demand_status, String current_supply_status, Integer expected_price_after_week_tk_per_kg, Integer highestPricePerKgOrUnit, String area_location, Integer lowestPricePerKgOrUnit, String reason_for_advised_rate, Date updateDate) {
        this.areaCode = areaCode;
        this.cropID = cropID;
        this.cropName = cropName;
        this.current_demand_status = current_demand_status;
        this.current_supply_status = current_supply_status;
        this.expected_price_after_week_tk_per_kg = expected_price_after_week_tk_per_kg;
        this.highestPricePerKgOrUnit = highestPricePerKgOrUnit;
        this.area_location = area_location;
        this.lowestPricePerKgOrUnit = lowestPricePerKgOrUnit;
        this.reason_for_advised_rate = reason_for_advised_rate;
        this.updateDate = updateDate;
    }
    // Getters and Setters
    // ...
}
