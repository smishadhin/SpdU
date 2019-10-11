
package onuchokri;

import java.sql.*;


public class databaseConnection {
    public  void databaseConnection(){
        Connection c = null;
        Statement stmt = null;
        try {
            Class.forName("org.sqlite.JDBC");
            c = DriverManager.getConnection("jdbc:sqlite:teacherinfo.db");
            stmt = c.createStatement();
            String sql = "create table if not exists teacher(teacherini  VARCHAR(10) PRIMARY KEY, teacherid   TEXT )";
            String sql2 = "create table if not exists course(coursecode  TEXT , coursetitle   TEXT )";
            String sql3 = "create table if not exists information(teacherinitial  VARCHAR(10) , teacherid   TEXT ,coursecode  VARCHAR(200) , coursetitle   TEXT)";
            stmt.executeUpdate(sql2);
              stmt.executeUpdate(sql3);
            stmt.executeUpdate(sql);
            stmt.close();
            c.close();
        } catch ( Exception e ) {
           // System.err.println( e.getClass().getName() + ": " + e.getMessage() );
           // System.exit(0);
        }
    }
    
}
