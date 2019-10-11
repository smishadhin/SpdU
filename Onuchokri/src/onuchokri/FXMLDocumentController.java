/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package onuchokri;


import java.net.URL;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Label;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javafx.scene.image.Image;
import javafx.stage.Stage;

/**
 *
 * @author shadhin
 */
public class FXMLDocumentController implements Initializable{
     
    @FXML
    private Label authentication;
    @FXML
    private TextField userNameTextField;
    @FXML
    private PasswordField passwardTextField;
    @FXML
    private void loginButtonAction(ActionEvent event) throws Exception {
        if(userNameTextField.getText().toUpperCase().equals("USERNAME") && passwardTextField.getText().equals("password")){
            logIn(event);
        }else{
            authentication.setText("Please try again");
          }
    }
        
    
     void logIn(ActionEvent event) throws Exception{
        
        Stage datastStage = (Stage)((Node)event.getSource()).getScene().getWindow();
        Parent root = FXMLLoader.load(getClass().getResource("data.fxml"));
        datastStage.setTitle("Onuchokri");
       
        Image icon = new Image(getClass().getResourceAsStream("blooddrop.png"));
        datastStage.getIcons().add(icon);
        
        Scene dataScene = new Scene(root);
        datastStage.setScene(dataScene);

        datastStage.setResizable(true);
        datastStage.show();
//        Onuchokri onuchokri =new Onuchokri();
//        onuchokri.stage.close();
        
        
    }

    @Override
    public void initialize(URL location, ResourceBundle resources) {
    }
      
}
