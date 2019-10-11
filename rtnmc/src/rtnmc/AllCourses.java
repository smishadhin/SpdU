/*
 * This code is written by Muhiminul Islam Shadhin (website: shadhin.slasstec.com) and he is copyright owner
 * Only  Muhiminul Islam Shadhin (website: shadhin.slasstec.com) has the authority to change the code.
 * If you are viewing or editing the code without the permission of  Muhiminul Islam Shadhin (website: shadhin.slasstec.com) then its a crime and you
are breaking the law of copyright.
 */


package rtnmc;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.sql.Statement;
import org.apache.poi.ss.usermodel.Cell;
import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.xssf.usermodel.XSSFSheet;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;



/**
 *
 * @author Muhiminul Islam Shadhin <smi.shadhin at gmail.com>
 */
public class AllCourses {

    private String semString;
    private String verString;

    // Biodata insert = new Biodata();
    public void FilterCourses(File file) throws FileNotFoundException, IOException, ClassNotFoundException, SQLException {
       // Biodata iv = new Biodata();
        ConnectionDatabase dbConnectionDatabase = new ConnectionDatabase();
        dbConnectionDatabase.databaseConnection();

        Class.forName("org.sqlite.JDBC");
        Connection connection = DriverManager.getConnection("jdbc:sqlite:course.db");
        connection.setAutoCommit(false);
        Statement stmt = connection.createStatement();
        String sql2 = "INSERT INTO courselist (CourseCode) "
                + "VALUES (?);";

        PreparedStatement pst = connection.prepareStatement(sql2);

        boolean a = false;
        FileInputStream fis = new FileInputStream(file);
        XSSFWorkbook myWorkBook = new XSSFWorkbook(fis);
        XSSFSheet mySheet = myWorkBook.getSheetAt(0);
        Row row;
        Cell cell;
        for (int k = 0; k <= mySheet.getLastRowNum(); k++) {
            row = mySheet.getRow(k);
            if (row == null) {
                continue;
            }
            for (int l = 0; l <= row.getLastCellNum(); l++) {
                cell = row.getCell(l);
                if (cell == null) {
                    continue;
                }
                if (cell.getCellType() == Cell.CELL_TYPE_NUMERIC) {
                    continue;
                } else if (cell.getCellType() == Cell.CELL_TYPE_STRING) {
                    if (cell.getStringCellValue().contains("Semester:")) {
                        //System.out.println(cell.getStringCellValue().replaceAll("\\s+", ""));
                        semString = cell.getStringCellValue().replaceAll("\\s+", "");
                    }
                    if (cell.getStringCellValue().contains("Version:")) {
                        //System.out.println(cell.getStringCellValue().replaceAll("\\s+", ""));
                        verString = cell.getStringCellValue().replaceAll("\\s+", "");
                    }
                    if (cell.getStringCellValue().equals("Course")) {
                        int courseRow = row.getRowNum();
                        int courseCell = cell.getColumnIndex();
                        //  System.out.println(courseRow);
                        //  System.out.println(courseCell);
                        for (int r = courseRow; r <= mySheet.getLastRowNum(); r++) {
                            Row row1 = mySheet.getRow(r);
                            if (row1 == null) {
                                continue;
                            }
                            //  for (int c = j; c <= row1.getLastCellNum(); c++) {
                            Cell cell1 = row1.getCell(courseCell);
                            if (cell1 == null) {
                                continue;
                            }
                            if (cell1.getCellType() == cell1.CELL_TYPE_NUMERIC) {
                                //System.out.print(cell1.getNumericCellValue());
                                continue;
                            }
                            if (cell1.getCellType() == cell1.CELL_TYPE_BLANK) {
                                continue;
                            }
                            if (cell1.getCellType() == cell1.CELL_TYPE_STRING) {
                                if (cell1.getStringCellValue().equals("Course") || cell1.getStringCellValue().equals("08:30-10:00") || cell1.getStringCellValue().equals("10:00-11:30")
                                        || cell1.getStringCellValue().equals("11.30-01:00") || cell1.getStringCellValue().equals("01:00-02:30") || cell1.getStringCellValue().equals("02:30-04:00")
                                        || cell1.getStringCellValue().equals("04:00-05:30") || cell1.getStringCellValue().equals("M.Sc")|| cell1.getStringCellValue().equals("09:00-11:00")
                                        || cell1.getStringCellValue().equals("11:00-01:00")|| cell1.getStringCellValue().equals("01:00-03:00")|| cell1.getStringCellValue().equals("01:00-03:00")
                                        
                                         || cell1.getStringCellValue().equals("FAC")|| cell1.getStringCellValue().equals("FF")|| cell1.getStringCellValue().equals("AA")
                                        || cell1.getStringCellValue().equals("MDG") || cell1.getStringCellValue().equals("FS") || cell1.getStringCellValue().equals("SD")
                                        
                                        || cell1.getStringCellValue().equals("AAN")|| cell1.getStringCellValue().equals("MSA")|| cell1.getStringCellValue().equals("MHK")
                                        || cell1.getStringCellValue().equals("SMS")|| cell1.getStringCellValue().equals("MIH")|| cell1.getStringCellValue().equals("SMKH")
                                        || cell1.getStringCellValue().equals("MTHN")
                                        
                                        ) {
                                    continue;
                                }
                                // System.out.println(cell1.getStringCellValue());

                                try {

                                    pst.setString(1, cell1.getStringCellValue());
                                    pst.execute();

                                } catch (SQLException e) {

                                }

                            }

                        }
                    }
                }
            }

        }

        stmt.close();
        connection.commit();
       // iv.inserVersion(semString, verString);

    }

}
