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
public class courselistviewer implements Initializable {

    @FXML
    private TableView<courseEvent> coursetable;
    @FXML
    private TableColumn<courseEvent, String> justcoursecodecolm;
    @FXML
    private TableColumn<courseEvent, String> justcoursetitlecolm;

     ObservableList<courseEvent> infos = FXCollections.observableArrayList();
    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
       databaseConnection DC = new databaseConnection();
        DC.databaseConnection();
        justcoursecodecolm.setCellValueFactory(new PropertyValueFactory<>("courseCode"));
        justcoursetitlecolm.setCellValueFactory(new PropertyValueFactory<>("courseTitle"));
        
        coursetable.getColumns().addAll(justcoursecodecolm, justcoursetitlecolm);
        coursetable.setItems(connection());
    }    
    
    public ObservableList<courseEvent> connection() {
        {
            Connection c = null;
            Statement stmt = null;

            try {
                Class.forName("org.sqlite.JDBC");
                c = DriverManager.getConnection("jdbc:sqlite:teacherinfo.db");
                c.setAutoCommit(false);

                stmt = c.createStatement();
                ResultSet rs = stmt.executeQuery("SELECT  coursecode,coursetitle FROM course");
                while (rs.next()) {

                    String teacherinitialString = rs.getString("coursecode");
                    String teacheridsString = rs.getString("coursetitle");
                   

                    infos.add(new courseEvent(teacherinitialString, teacheridsString));

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
