# de.tensai.wcf.reactionsLimiter
Limits the allowed reactions for user groups within the last 24 h, 7 days and 30 days.
Includes English and German language.

## ACP (Users -> User Groups -> Edit User Group -> General Permissions -> Messages)
![ACP](https://github.com/Tensai75/de.tensai.wcf.reactionsLimiter/raw/main/resources/acp.jpg)

## Error message when the limit is reached
![Error_Message](https://github.com/Tensai75/de.tensai.wcf.reactionsLimiter/raw/main/resources/error_message.jpg)

### Minimum requirements
Woltlab Suite v5.2

### Limitations
The reaction limiter does count all reactions regardless of the likeable object type.

### Change log
#### v1.0.3
- Bug fix: only show error message on actual react action

#### v1.0.2
- set default value for all group types
- set minimum value to 0

#### v1.0.1
- fix for typo in the listener name
- use standard SQL syntax