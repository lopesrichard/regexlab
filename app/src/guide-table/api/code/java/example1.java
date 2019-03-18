import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class Main {
  public static void main(String[] args) {
      
    /* 1. Doing just a check using the simplest method */
    
    String string = "1a";

    if (string.matches("^\\d([a-z])$")) {
        // Do something
    }

    /* 2. Doing a search and getting the result */
    
    String regex  = "^\\d([a-z])$";
    String string = "1a";

    Pattern p = Pattern.compile(regex);
    Matcher m = p.matcher(string);
    
    if (m.matches()) {
        System.out.println(m.group()); // 1a
        System.out.println(m.group(1)); // a
    }

    /* 3. Doing a global search and getting the results */
    
    String regex  = "\\d([a-z])";
    String string = "1a2b3c";

    Pattern p = Pattern.compile(regex);
    Matcher m = p.matcher(string);
    
    while (m.find()) {
        System.out.print("Match: " + m.group() + " ");
        System.out.print("Group: " + m.group(1) + "\n");
    }

    /*
        Output:
        Match: 1a Group: a
        Match: 2b Group: b
        Match: 3c Group: c
    */
  }
}
