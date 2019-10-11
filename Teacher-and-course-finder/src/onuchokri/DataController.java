package onuchokri;

import java.io.File;
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
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.image.Image;
import javafx.stage.FileChooser;
import javafx.stage.Stage;
import javax.swing.JOptionPane;

public class DataController implements Initializable {

    boolean delet = false;

    @FXML
    private TableView<LocalEvent> dataTable;
    @FXML
    private TableColumn<LocalEvent, String> tecinicol;
    @FXML
    private TableColumn<LocalEvent, String> tecidcolcol;
    @FXML
    private TableColumn<LocalEvent, String> cocodecol;
    @FXML
    private TableColumn<LocalEvent, String> cotitlecol;
    @FXML
    private TextField deleteTextField;
    @FXML
    private TextField fileterTextField;
    ObservableList<LocalEvent> infos = FXCollections.observableArrayList();
    private ObservableList<LocalEvent> filteredData = FXCollections.observableArrayList();
    @FXML
    private TextField teacherInitextfield;
    @FXML
    private TextField teacheridtextfield;
    @FXML
    private TextField coursecodetextfield;
    @FXML
    private TextField coursetitletextfield;
    @FXML
    private Label filelable;
    private File file;
    @FXML
    private Button browsebuttonid;
    @FXML
    private Button generatebuttonid;

    //public String[] tliStrings=new String[2];
    ArrayList<datatypeteacher> tliStrings = new ArrayList<>();

    public void editAddress() {
        cotitlecol.getOnEditCommit();
    }

    @Override
    public void initialize(URL url, ResourceBundle rb) {
        databaseConnection DC = new databaseConnection();
        DC.databaseConnection();
        tecinicol.setCellValueFactory(new PropertyValueFactory<>("techini"));
        tecidcolcol.setCellValueFactory(new PropertyValueFactory<>("techid"));
        cocodecol.setCellValueFactory(new PropertyValueFactory<>("cocode"));
        cotitlecol.setCellValueFactory(new PropertyValueFactory<>("cotitle"));
        dataTable.getColumns().addAll(tecinicol, tecidcolcol, cocodecol, cotitlecol);
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
        generatebuttonid.setDisable(true);
        //  connection();
    }

//insert teacher info complete
    @FXML
    private void addteacherbuttonMethod(ActionEvent event) {

        if (teacherInitextfield.getText().isEmpty() == true || teacheridtextfield.getText().isEmpty() == true) {

            JOptionPane.showMessageDialog(null, "Please provide all the Informations \n Teacher Inital, Teacher ID");
        } else if (teacherInitextfield.getText().isEmpty() == false && teacheridtextfield.getText().isEmpty() == false) {
            teacherevent info = new teacherevent();

            String teacherInitil = teacherInitextfield.getText().toUpperCase();
            String idteacher = teacheridtextfield.getText();
            info.setTeacherinitial(teacherInitil);
            info.setIdteacher(idteacher);

            // dataTable.getItems().add(info);
            ////////////////////////database/////////////////////
            Connection c = null;
            Statement stmt = null;
            PreparedStatement pst = null;
            try {
                Class.forName("org.sqlite.JDBC");
                c = DriverManager.getConnection("jdbc:sqlite:teacherinfo.db");
                c.setAutoCommit(false);
                stmt = c.createStatement();
                String sql = "INSERT INTO teacher (teacherini,teacherid) "
                        + "VALUES (?,?);";

                pst = c.prepareStatement(sql);
                pst.setString(1, teacherInitil);
                pst.setString(2, idteacher);
                //  System.out.println("insert");

                pst.execute();

                stmt.close();
                c.commit();
                c.close();

            } catch (Exception e) {
                //  System.err.println(e.getClass().getName() + ": " + e.getMessage());
                //  System.exit(0);
            }

            ///////////////////////////////////////////////////
            teacherInitextfield.clear();
            teacheridtextfield.clear();

        }

    }

    //delet teacher and course complet
    @FXML
    private void deleteButtonMerhod(ActionEvent event) {

        Connection c = null;
        Statement stmt = null;
        PreparedStatement pst = null;

        try {
            Class.forName("org.sqlite.JDBC");
            c = DriverManager.getConnection("jdbc:sqlite:teacherinfo.db");
            c.setAutoCommit(false);
            stmt = c.createStatement();
            String sql2 = "DELETE from course where coursecode=?;";
            pst = c.prepareStatement(sql2);
            pst.setString(1, deleteTextField.getText().toUpperCase());

            pst.executeUpdate();
            pst.close();

            delet = true;

            stmt.close();
            c.commit();
            c.close();
            System.out.println("delet2");
        } catch (Exception e) {
            System.err.println(e.getClass().getName() + ": " + e.getMessage());
            System.exit(0);
        }
        try {
            Class.forName("org.sqlite.JDBC");
            c = DriverManager.getConnection("jdbc:sqlite:teacherinfo.db");
            c.setAutoCommit(false);
            stmt = c.createStatement();
            String sql = "DELETE from teacher where teacherini=?;";
            pst = c.prepareStatement(sql);
            pst.setString(1, deleteTextField.getText().toUpperCase());

            pst.executeUpdate();
            pst.close();

            delet = true;

            stmt.close();
            c.commit();
            c.close();
            System.out.println("delet1");
        } catch (Exception e) {
            System.err.println(e.getClass().getName() + ": " + e.getMessage());
            System.exit(0);
        }

    }

    public ObservableList<LocalEvent> connection() {
        {
            Connection c = null;
            Statement stmt = null;

            try {
                Class.forName("org.sqlite.JDBC");
                c = DriverManager.getConnection("jdbc:sqlite:teacherinfo.db");
                c.setAutoCommit(false);

                stmt = c.createStatement();
                ResultSet rs = stmt.executeQuery("SELECT distinct coursecode,teacherinitial,teacherid,coursetitle FROM information");
                while (rs.next()) {

                    String teacherinitialString = rs.getString("teacherinitial");
                    String teacheridsString = rs.getString("teacherid");
                    String coursecodeString = rs.getString("coursecode");
                    String coursetitleString = rs.getString("coursetitle");

                    infos.add(new LocalEvent(teacherinitialString, teacheridsString, coursecodeString, coursetitleString));

                }
                rs.close();
                stmt.close();
                c.close();
            } catch (Exception e) {
                System.err.println(e.getClass().getName() + ": " + e.getMessage());
                System.exit(0);
            }

            //////////filter code////////////
            filteredData.addAll(infos);
            infos.addListener(new ListChangeListener<LocalEvent>() {
                @Override
                public void onChanged(ListChangeListener.Change<? extends LocalEvent> change) {
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

    private boolean matchesFilter(LocalEvent courseinfo) {
        String filterString = fileterTextField.getText();
        if (filterString == null || filterString.isEmpty()) {

            return true;
        }

        String lowerCaseFilterString = filterString.toLowerCase();

        if (courseinfo.getTechini().toLowerCase().indexOf(lowerCaseFilterString) != -1) {
            return true;
        }// else if (courseinfo.getCocode().toLowerCase().indexOf(lowerCaseFilterString) != -1) {
//            return true;
//        } else if (courseinfo.getCotitle().toLowerCase().indexOf(lowerCaseFilterString) != -1) {
//            return true;
//        } else if (courseinfo.getTechid().toLowerCase().indexOf(lowerCaseFilterString) != -1) {
//            return true;
//        }

        return false;
    }

    private void reapplyTableSortOrder() {
        ArrayList<TableColumn<LocalEvent, ?>> sortOrder = new ArrayList<>(dataTable.getSortOrder());
        dataTable.getSortOrder().clear();
        dataTable.getSortOrder().addAll(sortOrder);
    }

    @FXML
    private void refreshbuttonMethod(ActionEvent event) throws Exception {

        Stage datastStage = (Stage) ((Node) event.getSource()).getScene().getWindow();
        Parent root = FXMLLoader.load(getClass().getResource("table.fxml"));
        datastStage.setTitle("Onuchokri");

        Image icon = new Image(getClass().getResourceAsStream("slasstec.png"));
        datastStage.getIcons().add(icon);

        Scene dataScene = new Scene(root);
        datastStage.setScene(dataScene);

        datastStage.setResizable(true);
        datastStage.show();

    }

    //add course info complete
    @FXML
    private void addcoursebuttonmethod(ActionEvent event) {
        if (coursecodetextfield.getText().isEmpty() == true || coursetitletextfield.getText().isEmpty() == true) {

            JOptionPane.showMessageDialog(null, "Please provide all the Informations \n Course Code , Course Title");
        } else if (coursecodetextfield.getText().isEmpty() == false && coursetitletextfield.getText().isEmpty() == false) {
            courseEvent ce = new courseEvent();

            String coursecode = coursecodetextfield.getText().toUpperCase();
            String coursetitle = coursetitletextfield.getText().toUpperCase();
            ce.setCourseCode(coursecode);
            ce.setCourseTitle(coursetitle);

            //dataTable.getItems().add(ce);
            ////////////////////////database/////////////////////
            Connection c = null;
            Statement stmt = null;
            PreparedStatement pst = null;
            try {
                Class.forName("org.sqlite.JDBC");
                c = DriverManager.getConnection("jdbc:sqlite:teacherinfo.db");
                c.setAutoCommit(false);
                stmt = c.createStatement();
                String sql = "INSERT INTO course (coursecode,coursetitle) "
                        + "VALUES (?,?);";

                pst = c.prepareStatement(sql);
                pst.setString(1, coursecode);
                pst.setString(2, coursetitle);
                System.out.println("insert");

                pst.execute();

                stmt.close();
                c.commit();
                c.close();

            } catch (Exception e) {
                System.err.println(e.getClass().getName() + ": " + e.getMessage());
                System.exit(0);
            }

            ///////////////////////////////////////////////////
            coursecodetextfield.clear();
            coursetitletextfield.clear();

        }

    }

    @FXML
    private void browsebuttonmethod(ActionEvent event) throws ClassNotFoundException, SQLException {
        Stage fileStage = new Stage();
        FileChooser fileChooser = new FileChooser();
        fileChooser.setTitle("Open File");
        fileChooser.setInitialDirectory(new File(System.getProperty("user.home")));
        fileChooser.getExtensionFilters().add(
                new FileChooser.ExtensionFilter("Excel file.xlsx", "*.xlsx")
        );
        file = fileChooser.showOpenDialog(fileStage);
        if (file != null) {
            filelable.setText("file choosed");
            browsebuttonid.setDisable(true);
            generatebuttonid.setDisable(false);
        }
        
       
        
    }

    @FXML
    private void generatebuttonmethod(ActionEvent event) throws ClassNotFoundException, SQLException, Exception {

        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle("Information Dialog");
        alert.setHeaderText(null);
        alert.setContentText("Your old routine informations will be deleted.");
        
         Connection c2 = null;
        Statement stmt2 = null;
        Class.forName("org.sqlite.JDBC");
        c2 = DriverManager.getConnection("jdbc:sqlite:teacherinfo.db");
        c2.setAutoCommit(false);
        stmt2 = c2.createStatement();

        String sql2 = "delete  FROM information";
        stmt2.executeUpdate(sql2);

        stmt2.close();
        c2.commit();
        c2.close();
        
        
alert.showAndWait();
        

        

        generatebuttonid.setDisable(true);
        Connection c = null;
        Statement stmt = null;
        Class.forName("org.sqlite.JDBC");
        c = DriverManager.getConnection("jdbc:sqlite:teacherinfo.db");
        c.setAutoCommit(false);
        stmt = c.createStatement();
        ResultSet rs = stmt.executeQuery("SELECT  teacherini,teacherid FROM teacher");
        //  String sql2="delete  FROM information";
//          String sql3 = "create table if not exists information(teacherinitial  VARCHAR(10) , teacherid   TEXT ,coursecode  TEXT PRIMARY KEY, coursetitle   TEXT)";
        // stmt.executeQuery(sql2);
//         stmt.executeUpdate(sql3);
        while (rs.next()) {
            String techerinitial = rs.getString("teacherini");
            String teacherid = rs.getString("teacherid");
            //  System.out.println(techerinitial);
//            teacherSun sunday=new teacherSun();
//            sunday.sunday(techerinitial, file);
            //tliStrings[pos]=techerinitial;
            tliStrings.add(new datatypeteacher(techerinitial, teacherid));

        }
        rs.close();
        stmt.close();
        c.close();

        for (int i = 0; i < tliStrings.size(); i++) {
            // System.out.println(tliStrings.get(i));
            teacherSatur satur = new teacherSatur();
            satur.saturday(tliStrings.get(i).initial, tliStrings.get(i).tid, file);
            teacherSun sunday = new teacherSun();
            sunday.sunday(tliStrings.get(i).initial, tliStrings.get(i).tid, file);
            teacherMon mon = new teacherMon();
            mon.monday(tliStrings.get(i).initial, tliStrings.get(i).tid, file);
            teacherTues tues = new teacherTues();
            tues.tuesday(tliStrings.get(i).initial, tliStrings.get(i).tid, file);
            teacherWed wed = new teacherWed();
            wed.wednesday(tliStrings.get(i).initial, tliStrings.get(i).tid, file);
            teacherThurs thurs = new teacherThurs();
            thurs.thursday(tliStrings.get(i).initial, tliStrings.get(i).tid, file);
        }
        JOptionPane.showMessageDialog(null, "Routine Genaration Complete.\n PLEASE REFRESH NOW");

    }

    @FXML
    private void teacherlistbuttonmethod(ActionEvent event) throws IOException {
        Stage stage =new Stage();
        
        Parent root = FXMLLoader.load(getClass().getResource("teacher.fxml"));
      
        stage.setTitle("Course and Teacher Viewer");
        Image icon = new Image(getClass().getResourceAsStream("slasstec.png"));
        stage.getIcons().add(icon);
        Scene scene = new Scene(root);
        
        stage.setScene(scene);
        
        stage.show();
    }

    @FXML
    private void courselistbuttonmethod(ActionEvent event) throws IOException {
         Stage stage =new Stage();
        
        Parent root = FXMLLoader.load(getClass().getResource("course.fxml"));
      
        stage.setTitle("Course and Teacher Viewer");
        Image icon = new Image(getClass().getResourceAsStream("slasstec.png"));
        stage.getIcons().add(icon);
        Scene scene = new Scene(root);
        
        stage.setScene(scene);
        
        stage.show();
    }

}
