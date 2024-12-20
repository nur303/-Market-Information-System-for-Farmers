package com.example.demo2.farmerconnect;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.sql.*;
import java.time.LocalDate;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

@RestController
public class AnalystRestController {
    AnalystMarketPriceAndAdvisedRates_T marketDataInput = new AnalystMarketPriceAndAdvisedRates_T();
    AnalystDB analystDB = new AnalystDB();
    AnalystService analystService = new AnalystService();
    HarvestDB harvestDB = new HarvestDB();
    BidDB bidDB = new BidDB();
    Connection conn;
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

    @RequestMapping("/api/pricing-graph")
    public ResponseEntity<?> getPricingGraph(
            @RequestParam String location,
            @RequestParam String crop,
            @RequestParam String month,
            @RequestParam String priceType
    ) {

        String startOfMonth = month + "-01";
        LocalDate startDate = LocalDate.parse(startOfMonth);
        LocalDate endDate = startDate.plusMonths(1);

        String sql = "SELECT update_date, highest_price_per_kg_or_unit, lowest_price_per_kg_or_unit  " +
                "FROM MARKET_PRICE_FOR_CROPS_AND_ADVISED_RATES_T " +
                "WHERE area_code = ? AND cropID = ? " +
                "AND update_date >= ? AND update_date < ?";

        List<MarketPriceGraph> marketPriceGraphList = new ArrayList<>();

        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setString(1, location);
            ps.setString(2, crop);
            ps.setDate(3, Date.valueOf(startDate));
            ps.setDate(4, Date.valueOf(endDate));

            ResultSet rs = ps.executeQuery();

            while (rs.next()) {
                LocalDate date = rs.getDate("update_date").toLocalDate();
                if (priceType.equals("high")) {
                    int price = rs.getInt("highest_price_per_kg_or_unit");
                    marketPriceGraphList.add(new MarketPriceGraph(date, price));
                }else{
                    int price = rs.getInt("lowest_price_per_kg_or_unit");
                    marketPriceGraphList.add(new MarketPriceGraph(date, price));
                }

            }

            return ResponseEntity.ok(marketPriceGraphList);
        } catch (SQLException e) {
            e.printStackTrace();
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR)
                    .body(Map.of("error", "Failed to fetch pricing data", "message", e.getMessage()));
        }
    }

    @PostMapping("/api/AnalystInputForm")
    public ResponseEntity<String> handleFormSubmission(@RequestBody Map<String,Object >inputData) {
        try {
//            System.out.println("Received Input Data: " + inputData);
            // saving data to handle class :
            marketDataInput.setCropID((String)inputData.get("crop"));
            marketDataInput.setAreaCode((String)inputData.get("location"));
            marketDataInput.setCurrent_supply_status((String)inputData.get("supplyStatus"));
            marketDataInput.setReason_for_advised_rate( (String)inputData.get("reason"));
            marketDataInput.setCurrent_demand_status((String)inputData.get("demandStatus"));
            // Convert expectedPrice, highestPrice, and lowestPrice to Integer
            Object expectedPriceObj = inputData.get("expectedPrice");
            Object highestPriceObj = inputData.get("highestPrice");
            Object lowestPriceObj = inputData.get("lowestPrice");

            if (expectedPriceObj != null) {
                marketDataInput.setExpected_price_after_week_tk_per_kg(
                        Integer.parseInt(expectedPriceObj.toString()));
            }
            if (highestPriceObj != null) {
                marketDataInput.setHighestPricePerKgOrUnit(
                        Integer.parseInt(highestPriceObj.toString()));
            }
            if (lowestPriceObj != null) {
                marketDataInput.setLowestPricePerKgOrUnit(
                        Integer.parseInt(lowestPriceObj.toString()));
            }

            analystDB.save_market_data(marketDataInput);

            return ResponseEntity.ok("Data saved successfully!");
        } catch (Exception e) {

            return ResponseEntity.status(500).body("Failed to save data.");
        }
    }

    @GetMapping("/marketPrices")
    public ResponseEntity<List<AnalystMarketPriceAndAdvisedRates_T>> getMarketPrices() {
        return ResponseEntity.ok(analystService.showMarketPriceAndRates());
    }



//    /// //      all harvest info showing in table  //////
//    @GetMapping("/agent/all_harvests")
//    public ResponseEntity<List<Harvest_T>> getHarvestInfo() {
//        return ResponseEntity.ok(harvestDB.get_all_buyer_data());
//    }


    @DeleteMapping("/api/delete-market-price")
    public ResponseEntity<String> deleteMarketPrice(@RequestBody Map<String, Object> payload) {
        try {
            // Extract necessary parameters from the payload
//            String updateDate = (String) payload.get("updateDate");

            // Print the date to the console
//            System.out.println("Received Update Date: " + updateDate);
            String cropID = (String) payload.get("cropID");
            String areaCode = (String) payload.get("areaCode");
            LocalDate updateDate = LocalDate.parse((String) payload.get("updateDate"));
            java.sql.Date sqlDate = java.sql.Date.valueOf(updateDate);
//
            // Perform the deletion using the repository
            marketDataInput = new AnalystMarketPriceAndAdvisedRates_T(sqlDate, cropID, areaCode);
            System.out.println(analystDB.deleteData(marketDataInput));
            return ResponseEntity.ok("Record deleted successfully!");
        } catch (Exception e) {
            e.printStackTrace();
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body("Failed to delete the record.");
        }
    }
    @PutMapping("/api/update-market-price")
    public ResponseEntity<String> updateMarketPrice(@RequestBody Map<String,Object> payload) {
        try {
            LocalDate updateDate = LocalDate.parse((String) payload.get("updateDate"));
            java.sql.Date sqlDate = java.sql.Date.valueOf(updateDate);
            marketDataInput.setUpdateDate(sqlDate);
            marketDataInput.setCropID((String)payload.get("cropID"));
            marketDataInput.setAreaCode((String)payload.get("areaCode"));
            marketDataInput.setCurrent_supply_status((String)payload.get("supplyStatus"));
            marketDataInput.setReason_for_advised_rate( (String)payload.get("reasonForAdvisedRate"));
            marketDataInput.setCurrent_demand_status((String)payload.get("demandStatus"));
            Object expectedPriceObj = payload.get("expectedPriceAfterWeek");
            Object highestPriceObj = payload.get("highestPrice");
            Object lowestPriceObj = payload.get("lowestPrice");

            if (expectedPriceObj != null) {
                marketDataInput.setExpected_price_after_week_tk_per_kg(
                        Integer.parseInt(expectedPriceObj.toString()));
            }
            if (highestPriceObj != null) {
                marketDataInput.setHighestPricePerKgOrUnit(
                        Integer.parseInt(highestPriceObj.toString()));
            }
            if (lowestPriceObj != null) {
                marketDataInput.setLowestPricePerKgOrUnit(
                        Integer.parseInt(lowestPriceObj.toString()));
            }


//            System.out.println("Received Update Data: " + payload);
//            System.out.println("updated data :"+marketDataInput.toString());
            // Call the database method to update the record
            boolean isUpdated =  analystDB.updateData(marketDataInput);
            if (isUpdated) {
                return ResponseEntity.ok("Record updated successfully!");
            } else {
                return ResponseEntity.status(HttpStatus.NOT_FOUND).body("No matching record found to update.");
            }
        } catch (Exception e) {
            e.printStackTrace();
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).body("Failed to update record.");
        }
    }


    @GetMapping("/all_harvest_bids")
    public ResponseEntity<List<Bid_T>> getAllBids() {
        return ResponseEntity.ok(bidDB.get_all_Bids_data());
    }

}

