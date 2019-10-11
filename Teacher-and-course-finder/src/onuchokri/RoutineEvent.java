package onuchokri;


public class RoutineEvent {

    private String day;
    private String name;
    private String courseCode;
    private String time;
    private String room;

    public String getDay() {
        return day;
    }

    public void setDay(String day) {
        this.day = day;
    }

    public RoutineEvent(){
       this.day = null;
        this.name = null;
        this.courseCode = null;
        this.time = null;
        this.room = null;;

    }


    public RoutineEvent(String day, String name, String courseCode, String time, String room){
       this.day = day;
        this.name = name;
        this.courseCode = courseCode;
        this.time = time;
        this.room = room;

    }





    public String getName() {
        return name;
    }

    /**
     * @param name the name to set
     */
    public void setName(String name) {
        this.name = name;
    }


    public String getCourseCode() {
        return courseCode;
    }

    
    public void setCourseCode(String courseCode) {
        this.courseCode = courseCode;
    }


    /**
     * @return the time
     */
    public String getTime() {
        return time;
    }

    /**
     * @param time the time to set
     */
    public void setTime(String time) {
        this.time = time;
    }

    /**
     * @return the room
     */
    public String getRoom() {
        return room;
    }
    
     public void setRoom(String room) {
        this.room = room;
    }


}