package com.example.demo2.farmerconnect;

import lombok.AllArgsConstructor;
import lombok.Data;

import java.sql.Date;
import java.time.LocalTime;

@Data
@AllArgsConstructor
public class Bid_T {
    private int bidID;
    private int buyerID;
    private String buyerName;
    private String buyerLocation;
    private int buyerPhone;
    private int harvestID;
    private int biddingPrice;
    private LocalTime timeOfBidding;
    private Date dateOfBidding;

    // for harvest
    private Date harvestDate;
    private String cropName;
    private String harvestLocation;

    private int farmerID;
    private String farmerName;
    private int farmerPhone;
    private String farmerLocation;

    private int inStock;
    private int quantity;
    private String quality;
    private int askingPrice;

    public Bid_T() {
    }

    public Bid_T(int biddingPrice, int buyerID, int harvestID) {
        this.biddingPrice = biddingPrice;
        this.buyerID = buyerID;
        this.harvestID = harvestID;
    }
}
