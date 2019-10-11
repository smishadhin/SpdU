/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package onuchokri;

import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.image.Image;
import javafx.stage.Stage;

/**
 *
 * @author shadhin
 */
public class courseOfTeacher extends Application {
    public Stage stage;
    
    @Override
    public void start(Stage stage) throws Exception {
        Parent root = FXMLLoader.load(getClass().getResource("table.fxml"));
      
        stage.setTitle("Course and Teacher Viewer");
        Image icon = new Image(getClass().getResourceAsStream("slasstec.png"));
        stage.getIcons().add(icon);
        Scene scene = new Scene(root);
        
        stage.setScene(scene);
        
        stage.show();
        
    }

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        launch(args);
    }
    
}
