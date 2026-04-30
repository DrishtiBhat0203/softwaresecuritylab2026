# Browser Artifact Analysis & User Activity Extraction

## Aim
To inspect and analyze browser artifacts such as history, cookies, and cached data in order to understand user behavior and identify potential security and privacy risks.

---

## Theory
Web browsers store different types of artifacts during normal usage, including browsing history, cookies, cache, and download records. These are generally stored in structured formats like SQLite databases.

From a forensic and security perspective, this stored data is very valuable because it can reveal:
- User activity and browsing patterns  
- Frequently visited websites  
- Sensitive session-related data  
- Traces of potential attacks  

If not properly secured, this data can be exploited by attackers.

---

## Tools Used
- NirSoft Browser History Viewer  
- Browser Developer Tools (optional)  
- Cache/Cookie extraction utilities  

---

## Methodology

### Step 1: Download and Launch Tool
- Download NirSoft Browser History Viewer  
- Open the tool  

### Step 2: Load Browser Data
- Open **Browser History Viewer**  
- Go to **Advanced Options**  
- Select:
  - Load history from last days  
  - Load history from current system  

### Step 3: Analyze Browser History
Observe the following:
- Visited URLs  
- Page titles  
- Visit timestamps  
- Duration of visits  
- User profile  

### Step 4: Inspect Important Entries
- Identify login pages  
- Analyze navigation flow  
- Detect frequently visited websites  

### Step 5: Session & Storage Analysis
- Extract session IDs and stored data using cache/cookie tools  

---

## Security Observations

### Session & Login Risks
- Cookies may lack security flags such as: HttpOnly,same site  
- This can lead to: Session hijacking , XSS and CSRF attacks
  
### User Behavior Tracking
- Visit count and timestamps help determine user behavioural patterns  
- Unusual activity may indicate: Phishing attempts and social engineering 

### Attack Possibilities
- If session data is exposed: Attackers can impersonate users and gain unauthorized access to accounts  
---
## Results
- Extracted user activity details including:
  - Visited URLs  
  - Timestamps  
  - Frequency of visits  
- Identified potential privacy risks from stored browser artifacts  

---

## Conclusion
Browser artifacts provide deep insights into user behavior and system usage. While they are useful for forensic analysis, they also introduce privacy and security risks if accessed by unauthorized users.

Proper security measures such as secure cookie flags, encryption, and restricted access should be implemented.

---
