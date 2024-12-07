package com.example.demo2.farmerconnect;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import lombok.Data;

import java.sql.Date;
import java.time.LocalDate;

@Data
@Entity
@Table(name = "MARKET_PRICE_FOR_CROPS_AND_ADVISED_RATES_T")
public class AnalystMarketPriceAndAdvisedRates_T {

    @Id
    private Date update_date;
    @Id
    private String cropID;

    @Id
    private String areaCode;
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


    // Getters and Setters
    // ...
}
