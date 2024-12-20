package com.example.demo2.farmerconnect;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class BidDB {
    Connection conn ;
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


    public List<User_T> get_all_buyer_data(){
        List<User_T> list = new ArrayList();
        String sql = "SELECT userID,user_name,phone_number From TARGET_USER_T where user_type = 'Buyer'";
        try{
            PreparedStatement ps = conn.prepareStatement(sql);
            ResultSet rs = ps.executeQuery();
            while(rs.next()){
                User_T bigData = new User_T();
                bigData.setUserID(rs.getInt("userID"));
                bigData.setUserName(rs.getString("user_name"));
                bigData.setPhoneNumber(rs.getInt("phone_number"));
                list.add(bigData);

            }
            return list;
        }catch (SQLException ex){
            throw new RuntimeException(ex);

        }

    }
    public void save_Bid_By_Buyer_data(Bid_T bigData ){
        String sql = "insert  INTO BID_T (buyerid,harvestid,bidding_price) VALUES(?,?,?)";

        try {
            PreparedStatement ps = conn.prepareStatement(sql);

            ps.setInt(1, bigData.getBuyerID());
            ps.setInt(2,bigData.getHarvestID());
            ps.setInt(3, bigData.getBiddingPrice());
          ps.execute();
        } catch (SQLException e) {
            throw new RuntimeException(e);
        }
    }
    public List<Bid_T> get_all_Bids_data() {
        List<Bid_T> list = new ArrayList<>();
        String sql = "SELECT b.bidID, b.buyerID, buyer.user_name AS buyer_name, buyer.phone_number AS buyer_phone, buyer.area_code AS buyer_location, " +
                "b.bidding_price, b.time_of_bidding, b.date_of_bidding, h.harvestId, h.update_date AS harvest_date, " +
                "c.crop_name, a.area_location AS harvest_location, h.farmerID, farmer.user_name AS farmer_name, " +
                "farmer.phone_number AS farmer_phone, farmer.area_code AS farmer_location, h.inStock, " +
                "h.quantity_in_KG AS quantity, h.quality, h.askingPrice " +
                "FROM Bid_T b " +
                "LEFT JOIN HARVEST_T h ON b.harvestID = h.harvestId " +
                "LEFT JOIN TARGET_USER_T buyer ON b.buyerID = buyer.userID " +
                "LEFT JOIN TARGET_USER_T farmer ON h.farmerID = farmer.userID " +
                "LEFT JOIN CROP_T c ON h.cropID = c.cropID " +
                "LEFT JOIN AREA_T a ON h.area_code = a.area_code";
        try {
            PreparedStatement ps = conn.prepareStatement(sql);
            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                Bid_T bid = new Bid_T();

                // Populate bid information
                bid.setBidID(rs.getInt("bidID"));
                bid.setBuyerID(rs.getInt("buyerID"));
                bid.setBuyerName(rs.getString("buyer_name"));
                bid.setBuyerPhone(rs.getInt("buyer_phone"));
                bid.setBuyerLocation(rs.getString("buyer_location"));
                bid.setBiddingPrice(rs.getInt("bidding_price"));
                bid.setTimeOfBidding(rs.getTime("time_of_bidding").toLocalTime());
                bid.setDateOfBidding(rs.getDate("date_of_bidding"));

                // Populate harvest information
                bid.setHarvestID(rs.getInt("harvestId"));
                bid.setHarvestDate(rs.getDate("harvest_date"));
                bid.setCropName(rs.getString("crop_name"));
                bid.setHarvestLocation(rs.getString("harvest_location"));
                bid.setFarmerID(rs.getInt("farmerID"));
                bid.setFarmerName(rs.getString("farmer_name"));
                bid.setFarmerPhone(rs.getInt("farmer_phone"));
                bid.setFarmerLocation(rs.getString("farmer_location"));
                bid.setInStock(rs.getInt("inStock"));
                bid.setQuantity(rs.getInt("quantity"));
                bid.setQuality(rs.getString("quality"));
                bid.setAskingPrice(rs.getInt("askingPrice"));

                // Add bid object to the list
                list.add(bid);
            }
            rs.close();
            ps.close();
        } catch (SQLException ex) {
            throw new RuntimeException(ex);
        }
        return list;
    }


}
