
package onuchokri;

import java.sql.*;


public class databaseConnection {
    public  void databaseConnection(){
        Connection c = null;
        Statement stmt = null;
        try {
            Class.forName("org.sqlite.JDBC");
            c = DriverManager.getConnection("jdbc:sqlite:donationMembers.db");
            stmt = c.createStatement();
            String sql = "create table if not exists Members(Name  TEXT , BloodGroup   TEXT ,ContactNo  TEXT, Age   TEXT)";
            stmt.executeUpdate(sql);
            stmt.close();
            c.close();
        } catch ( Exception e ) {
           // System.err.println( e.getClass().getName() + ": " + e.getMessage() );
           // System.exit(0);
        }
    }
    
}
