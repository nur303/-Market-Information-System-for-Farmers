package com.example.demo2.farmerconnect;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import lombok.Data;

@Data
@Entity
@Table(name = "MARKET_PRICE_FOR_CROPS_AND_ADVISED_RATES_T")
public class MarketPriceAndAdvisedRates_T {

    @Id
    private int update_date;
    @Id
    private String cropID;
    private String cropName;
    @Id
    private String areaCode;
    private Integer highestPricePerKgOrUnit;
    private Integer lowestPricePerKgOrUnit;
    private Integer highestPriceFromWholesalers;
    private Integer lowestPriceFromWholesalers;

    // Getters and Setters
    // ...
}
