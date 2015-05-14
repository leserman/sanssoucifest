<?php

class SSFTimer {
  private $startTime;
  private $endTime;
  private $startTimeInUSec;
  private $endTimeInUSec;
  private $cumDurationInUSec;
  private $infoString;
  private $showUSec = -1;

  // The constructor  set the $infoString for later display and resets and starts the timer.
  public function __construct($infoString) {
    $this->startTime = time();
    $this->startTimeInUSec = microtime(true);
    SSFDebug::globalDebugger()->becho('this->startTimeInUSec', $this->startTimeInUSec, $this->showUSec);
    $this->endTimeInUSec = 0;
    $this->cumDurationInUSec = 0;
    $this->infoString = $infoString;
  }

  // start() resets and starts the timer.
  public function start() {
    $this->startTime = time();    
    $this->startTimeInUSec = microtime(true);
    SSFDebug::globalDebugger()->becho('this->startTimeInUSec', $this->startTimeInUSec, $this->showUSec);
    $this->endTimeInUSec = 0;
    $this->$cumDurationInUSec = 0;
  }
  
  // stop() stops the timer.
  public function stop() {
    $this->endTime = time();  
    $this->endTimeInUSec = microtime(true);
    SSFDebug::globalDebugger()->becho('this->endTimeInUSec', $this->endTimeInUSec, $this->showUSec);
    $durationInUSec = microtime(true) - $this->startTimeInUSec;
    $this->cumDurationInUSec += $durationInUSec;
  }
  
  // pause() stops the timer and updates the cumulative duration.
  public function pause() {
    $durationInUSec = microtime(true) - $this->startTimeInUSec;
    $this->cumDurationInUSec += $durationInUSec;
  }
  
  // resume() restes the timer while leaving the cumulative duration unchanged.
  public function resume() {
    $this->startTimeInUSec = microtime(true);    
  }

  // stopAndDisplayResult() stops the timer and displays the result.
  public function stopAndDisplayResult() {
    $this->stop();
    $this->displayResult();
  }
  
  // displayResult() displays the result of the timer.
  public function displayResult() {
    $duration = $this->endTime - $this->startTime;
//    $durationInUSec = 
    $startTimeDisplay = date('Y-m-d H:i:s', $this->startTime);
    $endTimeDisplay = date('Y-m-d H:i:s', $this->endTime);
    $durationDisplay = date('i:s', $duration);         // TODO - Add hours to this output format. Hours should be 0, but not so in trial on 5/9/15.
//    echo '<br><br>### Timer Duration: ' . $durationDisplay . '; Started: ' . $startTimeDisplay . '; Completed: ' . $endTimeDisplay . "<br>" . PHP_EOL;
    echo '<div class="instrumentationText">### <span class="highlighted">INSTRUMENTING </span>' . $this->infoString . "</br>" . PHP_EOL; 
    echo '  ### <span class="highlighted">Duration: ' . sprintf('%.3f', $this->cumDurationInUSec) . ' sec;</span> Started: ' . $startTimeDisplay . '; Completed: ' . $endTimeDisplay . '</div>' . PHP_EOL;
    //debug_print_backtrace();    
  }

}

?>
