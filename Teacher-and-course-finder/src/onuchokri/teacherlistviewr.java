/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package onuchokri;

import java.net.URL;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ResourceBundle;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.cell.PropertyValueFactory;

/**
 * FXML Controller class
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
public class teacherlistviewr implements Initializable {

    @FXML
    private TableColumn<teacherevent, String> justteacherinitialcolm;
    @FXML
    private TableColumn<teacherevent, String> justtehacherIdcolm;
    
    
    ObservableList<teacherevent> infos = FXCollections.observableArrayList();
    @FXML
    private TableView<teacherevent> teachertable;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        databaseConnection DC = new databaseConnection();
        DC.databaseConnection();
        justteacherinitialcolm.setCellValueFactory(new PropertyValueFactory<>("teacherinitial"));
        justtehacherIdcolm.setCellValueFactory(new PropertyValueFactory<>("idteacher"));
        
        teachertable.getColumns().addAll(justteacherinitialcolm, justtehacherIdcolm);
        teachertable.setItems(connection());
    }    
    
    public ObservableList<teacherevent> connection() {
        {
            Connection c = null;
            Statement stmt = null;

            try {
                Class.forName("org.sqlite.JDBC");
                c = DriverManager.getConnection("jdbc:sqlite:teacherinfo.db");
                c.setAutoCommit(false);

                stmt = c.createStatement();
                ResultSet rs = stmt.executeQuery("SELECT  teacherini,teacherid FROM teacher");
                while (rs.next()) {

                    String teacherinitialString = rs.getString("teacherini");
                    String teacheridsString = rs.getString("teacherid");
                   

                    infos.add(new teacherevent(teacherinitialString, teacheridsString));

                }
                rs.close();
                stmt.close();
                c.close();
            } catch (Exception e) {
                System.err.println(e.getClass().getName() + ": " + e.getMessage());
                System.exit(0);
            }

            //////////filter code////////////
            
           

            return infos;
        }
    }
    
}
