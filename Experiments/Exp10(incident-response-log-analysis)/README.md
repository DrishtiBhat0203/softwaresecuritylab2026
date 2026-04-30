# Simulating Incident Response using Log Analysis

## Aim

- The aim of this experiment is to analyze system and application logs in order to identify suspicious activities such as repeated failed login attempts, and to simulate a basic incident response by detecting and controlling brute-force login behavior.

## Theory

- In modern systems, logs serve as one of the most reliable sources for identifying security incidents. Web servers such as Apache maintain access logs that record every request made to the server, including the request type, timestamp, and status code. These records help in observing patterns that may not be immediately visible during normal usage.

- One such pattern is repeated login attempts within a short period of time, which is often associated with brute-force attacks. In a brute-force attack, an attacker continuously tries different combinations of usernames and passwords to gain unauthorized access.

- Apart from server logs, applications can also maintain their own logs to capture user-level activity in a more detailed way. When both server-side logging and application-level monitoring are used together, along with restrictions such as limiting login attempts, a simple yet effective incident response mechanism can be implemented.

## Methodology

- The experiment began with the development of a basic login system using PHP and MySQL in the XAMPP environment. After starting the Apache and MySQL services, the login interface was accessed through a web browser.

- In the initial stage, multiple login attempts were carried out manually, and the Apache access logs were observed through the XAMPP control panel. These logs clearly showed repeated HTTP POST requests directed toward the login page, indicating multiple authentication attempts.

- In the next stage, the PHP code was modified to introduce tracking of login attempts using session variables. A threshold limit was defined, and once the number of failed attempts crossed this limit, the system temporarily blocked further login attempts for a fixed duration.

- To enhance visibility, a custom logging mechanism was also implemented. Each login attempt, whether successful or failed, was recorded in a file named `login.log` along with details such as timestamp and IP address.

- Finally, a brute-force scenario was simulated by intentionally performing multiple incorrect login attempts. Both the Apache access logs and the custom log file were then analyzed to observe how suspicious activity could be detected and controlled.

## Results and Discussion

The Apache access logs revealed multiple POST requests being made to the login page within short intervals, clearly indicating repeated login attempts. At the same time, the custom `login.log` file provided a more detailed view by recording each attempt along with its timestamp and IP address.

Once the number of failed attempts exceeded the defined threshold, the system successfully blocked further login attempts for a certain duration. This demonstrated a basic but effective response mechanism against brute-force behavior.

Overall, the experiment showed that log analysis, when combined with simple control logic, can help in identifying suspicious activities and limiting potential threats.
