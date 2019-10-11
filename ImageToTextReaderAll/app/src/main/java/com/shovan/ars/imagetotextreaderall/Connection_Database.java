package com.shovan.ars.imagetotextreaderall;


import java.net.URLEncoder;

public class Connection_Database extends DataReader {

    String URL = "http://slasstec.com/bdmake_money/feedback.php";
    String url = "";
    String response = "";



    public String insert(String Title, String Details, String Datetime) {
        try {
            url = URL + "?operasi=insert&title=" + Title + "&details=" + Details + "&datetime=" + Datetime;
            System.out.println("URL Insert data : " + url);
            response = call(url);
        } catch (Exception e) {
        }
        return response;
    }


}

