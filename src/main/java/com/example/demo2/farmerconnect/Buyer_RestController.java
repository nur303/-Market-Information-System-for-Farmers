package com.example.demo2.farmerconnect;

import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;
import java.util.Map;

@RestController
public class Buyer_RestController {
    HarvestDB harvestDB = new HarvestDB();
    BidDB bidDB = new BidDB();

    @GetMapping("/buyer_all_harvests")
    public ResponseEntity<List<Harvest_T>> getHarvestInfoForBuyer() {
        return ResponseEntity.ok(harvestDB.get_all_harvest_data());
    }

    @PostMapping("/buyer_submit_bid")
    public ResponseEntity<String> handleBidSubmission(@RequestBody Map<String,Object > payload) {
        try {
//            System.out.println(((String) payload.get("harvestId")));
//            System.out.println(((String) payload.get("bidPrice")));
//            System.out.println(((String) payload.get("buyerId")));
            int harvestID = Integer.parseInt((String) payload.get("harvestId"));
            int bidPrice = Integer.parseInt((String) payload.get("bidPrice"));
            int buyerID = Integer.parseInt((String) payload.get("buyerId"));

////            System.out.println(bidPrice);
////            System.out.println(buyerID);
            bidDB.save_Bid_By_Buyer_data(new Bid_T(bidPrice, buyerID, harvestID));
            return ResponseEntity.ok("Data saved successfully!");
        } catch (Exception e) {
            return ResponseEntity.status(500).body("Failed to save data.");
        }
    }
    @GetMapping("/buyer_all_list")
    public ResponseEntity<List<User_T>> getAllBuyerIDs() {
        return ResponseEntity.ok(bidDB.get_all_buyer_data());
    }


}
