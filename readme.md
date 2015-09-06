# Working Hours Calculator
This is a simple PHP function to calculate the working hours between 2 dates. This function has been heavily optimized for acuracy and performance.
## Function Parameters.
##### `$start`
An instance of `DateTime()` containing the start date and time.
##### `$end`
An instance of `DateTime()` containng the finish date and time.
##### `$working_hours`
A multidimensional `array` containing the working hours for every weekday (Mon-Sun, 0-6). Each weekday must specify the opening and closing times for that day in seconds since midnights. The follwing example shows the working hours as being 9am till 5pm Monday to Friday and closed on weekends.
```
$hours = [
    null, // Sun
    [32400, 61200], // Mon
    [32400, 61200], // Tue
    [32400, 61200], // Wed
    [32400, 61200], // Thu
    [32400, 61200], // Fri
    null //Sat
];
```
## Return Value
The returned value will be the number of working seconds which have passed between the 2 dates. 