package onuchokri;


import java.io.IOException;
import java.net.URL;
import java.sql.*;
import java.sql.DriverManager;
import java.util.ArrayList;
import java.util.ResourceBundle;
import javafx.beans.value.ChangeListener;
import javafx.beans.value.ObservableValue;
import javafx.collections.FXCollections;
import javafx.collections.ListChangeListener;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.image.Image;
import javafx.stage.Stage;
import javax.swing.JOptionPane;


public class DataController implements Initializable {
    boolean delet = false;
    
    @FXML
    private TextField nameTextField;
    @FXML
    private TextField bloodTextField;
    @FXML
    private TextField contactTextField;
    @FXML
    private TextField ageTextField;
    @FXML
    private TableView<LocalEvent> dataTable;
    @FXML
    private TableColumn<LocalEvent, String> nameColumn;
    @FXML
    private TableColumn<LocalEvent, String> bloodColumn;
    @FXML
    private TableColumn<LocalEvent, String> contactColumn;
    @FXML
    private TableColumn<LocalEvent, String> ageColumn;
    @FXML
    private TextField deleteTextField;
    @FXML
    private TextField fileterTextField;
    ObservableList<LocalEvent> infos=FXCollections.observableArrayList();
    private ObservableList<LocalEvent> filteredData = FXCollections.observableArrayList();
 
    
    @FXML
    public void editAddress(){
        ageColumn.getOnEditCommit();
    }
    
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        databaseConnection DC = new databaseConnection();
        DC.databaseConnection();
        nameColumn.setCellValueFactory(new PropertyValueFactory<>("name"));
        bloodColumn.setCellValueFactory(new PropertyValueFactory<>("blood"));
        contactColumn.setCellValueFactory(new PropertyValueFactory<>("contact"));
        ageColumn.setCellValueFactory(new PropertyValueFactory<>("age"));
        dataTable.getColumns().addAll(nameColumn,bloodColumn,contactColumn,ageColumn);
        dataTable.setItems(connection());
        dataTable.setItems(filteredData);

        // Listen for text changes in the filter text field
        fileterTextField.textProperty().addListener(new ChangeListener<String>() {
            @Override
            public void changed(ObservableValue<? extends String> observable,
                    String oldValue, String newValue) {

                updateFilteredData();
            }
        });
                  
        //connection();
     }


    @FXML
    private void addbuttonMethod(ActionEvent event) {
        
       if(nameTextField.getText().isEmpty() == true || bloodTextField.getText().isEmpty() == true || contactTextField.getText().isEmpty() == true || ageTextField.getText().isEmpty() == true ){

           JOptionPane.showMessageDialog(null, "Please provide all the Informations \n Name , Bloof Group, Contact No, Address");
       }
       else if(nameTextField.getText().isEmpty() == false && bloodTextField.getText().isEmpty() == false && contactTextField.getText().isEmpty() == false && ageTextField.getText().isEmpty() == false ){
            LocalEvent info = new LocalEvent();
        
        
        String name =nameTextField.getText().toUpperCase();
        String bg =bloodTextField.getText().toUpperCase();
        String contact =contactTextField.getText();
        String age =ageTextField.getText();
        info.setName(name);
        info.setBlood(bg);
        info.setContact(contact);
        info.setAge(age);
        dataTable.getItems().add(info);
        
        ////////////////////////database/////////////////////
        
    Connection c = null;
    Statement stmt = null;
    PreparedStatement pst =null;
    try {
      Class.forName("org.sqlite.JDBC");
      c = DriverManager.getConnection("jdbc:sqlite:donationMembers.db");
      c.setAutoCommit(false);
      stmt = c.createStatement();
      String sql = "INSERT INTO Members (Name,BloodGroup,ContactNo,Age) " +
                   "VALUES (?,?,?,?);"; 
      
      pst = c.prepareStatement(sql);
      pst.setString(1, name);
      pst.setString(2, bg);
      pst.setString(3, contact);
      pst.setString(4, age);
      
      pst.execute();
 
      stmt.close();
      c.commit();
      c.close();
    } catch ( Exception e ) {
      System.err.println( e.getClass().getName() + ": " + e.getMessage() );
      System.exit(0);
    }
 
        ///////////////////////////////////////////////////
               
        nameTextField.clear();
        bloodTextField.clear();
        contactTextField.clear();
        ageTextField.clear();
        }
 
    }

    @FXML
    private void deleteButtonMerhod(ActionEvent event) {
    
    Connection c = null;
    Statement stmt = null;
    PreparedStatement pst =null;
    try {
      Class.forName("org.sqlite.JDBC");
      c = DriverManager.getConnection("jdbc:sqlite:donationMembers.db");
      c.setAutoCommit(false);
      stmt = c.createStatement();
      String sql = "DELETE from Members where Name=?;";
      pst = c.prepareStatement(sql);
      pst.setString(1, deleteTextField.getText());
           
      pst.executeUpdate();
      pst.close();
      
      delet = true;
   
      stmt.close();
      c.commit();
      c.close();
    } catch ( Exception e ) {
      System.err.println( e.getClass().getName() + ": " + e.getMessage() );
      System.exit(0);
    }
          
 }
    
 
    
    public  ObservableList<LocalEvent> connection(){
  {
   Connection c = null;
    Statement stmt = null;
    
    try {
      Class.forName("org.sqlite.JDBC");
      c = DriverManager.getConnection("jdbc:sqlite:donationMembers.db");
      c.setAutoCommit(false);

      stmt = c.createStatement();
      ResultSet rs = stmt.executeQuery( "SELECT * FROM Members;" );
      while ( rs.next() ) {
         
         String  name = rs.getString("Name");
        String  bloodGroup = rs.getString("BloodGroup");
        String  contactNo = rs.getString("ContactNo");
         String age  = rs.getString("Age");
   
        infos.add(new LocalEvent(name,bloodGroup,contactNo,age));
    
      }
      rs.close();
      stmt.close();
      c.close();
    } catch ( Exception e ) {
      System.err.println( e.getClass().getName() + ": " + e.getMessage() );
      System.exit(0);
    }
  
    //////////filter code////////////
    filteredData.addAll(infos);
    infos.addListener(new ListChangeListener<LocalEvent>(){
        @Override
        public void onChanged(ListChangeListener.Change<? extends LocalEvent> change){
             updateFilteredData();
        }

    });
    
        return infos;
  }
    }
    
    private void updateFilteredData() {
         filteredData.clear();

        for (LocalEvent p : infos) {
            if (matchesFilter(p)) {
                filteredData.add(p);
            }
        }

        reapplyTableSortOrder();
       }
    
    private boolean matchesFilter(LocalEvent person) {
        String filterString = fileterTextField.getText();
        if (filterString == null || filterString.isEmpty()) {
      
            return true;
        }

        String lowerCaseFilterString = filterString.toLowerCase();

        if (person.getBlood().toLowerCase().indexOf(lowerCaseFilterString) != -1) {
            return true;
        } else if (person.getAge().toLowerCase().indexOf(lowerCaseFilterString) != -1) {
            return true;
        }else if (person.getContact().toLowerCase().indexOf(lowerCaseFilterString) != -1) {
            return true;
        }else if (person.getName().toLowerCase().indexOf(lowerCaseFilterString) != -1) {
            return true;
        }

        return false;
    }
    
    private void reapplyTableSortOrder() {
        ArrayList<TableColumn<LocalEvent, ?>> sortOrder = new ArrayList<>(dataTable.getSortOrder());
        dataTable.getSortOrder().clear();
        dataTable.getSortOrder().addAll(sortOrder);
    }
    
    

    @FXML
    private void refreshbuttonMethod(ActionEvent event) throws Exception {
        
        FXMLDocumentController ref = new FXMLDocumentController();
        ref.logIn(event);
     
    }

    @FXML
    private void creditButtonMethod(ActionEvent event) throws IOException {
        Stage datastStage = new Stage();//(Stage)((Node)event.getSource()).getScene().getWindow();
        Parent root = FXMLLoader.load(getClass().getResource("credits.fxml"));
        datastStage.setTitle("Onuchokri");
      
        Image icon = new Image(getClass().getResourceAsStream("blooddrop.png"));
        datastStage.getIcons().add(icon);
        Scene dataScene = new Scene(root);
        datastStage.setScene(dataScene);

        datastStage.setResizable(false);
        datastStage.show();
        
    }

    
}
