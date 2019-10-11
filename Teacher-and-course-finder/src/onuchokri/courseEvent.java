
package onuchokri;


public class courseEvent {
    
    private String courseCode;
    private String courseTitle;   

    public courseEvent(String courseCode, String courseTitle) {
        this.courseCode = courseCode;
        this.courseTitle = courseTitle;
    } 
    public courseEvent() {
        this.courseCode = null;
        this.courseTitle = null;
    }

    public String getCourseCode() {
        return courseCode;
    }

    public void setCourseCode(String courseCode) {
        this.courseCode = courseCode;
    }

    public String getCourseTitle() {
        return courseTitle;
    }

    public void setCourseTitle(String courseTitle) {
        this.courseTitle = courseTitle;
    }
    

    
    
              
    
}
 
