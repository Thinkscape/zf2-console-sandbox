<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ConsoleModel;
use Zend\Console\Adapter as Console;
use Zend\Console\Console as ConsoleStatic;
use Zend\Console\Adapter\Virtual;
use Zend\Console\ColorInterface as Color;


class IndexController extends AbstractActionController
{
    /**
     * Display usage information
     *
     * @return string
     */
    public function usageAction()
    {
        $script = basename($this->request->getScriptName());
        if(ConsoleStatic::isWindows()){
            $script .= '.bat';
        }else{
            $script = './'.$script;
        }

        return <<<USAGE
-------------------------------------------------------
 Matrix Screensaver - ZF2 Console application example.
-------------------------------------------------------
Usage:
      $script [--speed=X] [--intensity=X]
      $script ( --usage | --help | -h )

Parameters:
      --speed=X        - set speed of animation (1 to 9, defaults to 5)
      --intensity=X    - set intensity of the effect (0.1 to 50, defaults to 1)
      --usage/--help   - display this help


USAGE;
    }


    /**
     * Display the screensaver
     *
     * @return string
     */
    public function indexAction()
    {
        /**
         * Determine console dimensions
         */
        $console = $this->getConsole();
        $width   = $console->getWidth();
        $height  = $console->getHeight();

        /**
         * Bail out if Windows without Ansicon
         */
        if($console instanceof Virtual){
            return
                "I'm sorry, but Matrix does not work on stock Windows yet.\n".
                "To make it work, install ANSICON:\n ".
                "     https://github.com/adoxa/ansicon\n\n".
                "We are also working on supporting Windows without Ansicon.\n"
            ;
        }

        /**
         * Read options
         */
        /** @var $request \Zend\Console\Request */
        $speed          = (int)$this->request->getParam('speed',5);
        $intensity      = (float)$this->request->getParam('intensity',1);
        $maxLength      = min($intensity * ceil($height / 2), $height - 5);

        /**
         * Prepare state vars
         */
        $chars = str_split('0123456789XY$&@%**%QR#OGHNBM',1);
        $charEnd = count($chars)-1;
        $totalCount = $width * $intensity;

        /**
         * Init slugs
         */
        do{
            $slugs[] = array(
                'head'   => $chars[mt_rand(0, $charEnd)],
                'tail'   => array(),
                'length' => mt_rand(max(ceil($maxLength / 3),3), $maxLength),
                'y'      => 1,
                'x'      => mt_rand(1, $width),
                'delay'  => mt_rand(0, $totalCount),
            );
        }while(count($slugs) < $totalCount);


        /**
         * Clear screen
         */
        $console->hideCursor();
        $console->clear();

        /**
         * Main loop
         */
        do{
            foreach($slugs as &$slug){
                $y      = &$slug['y'];
                $x      = &$slug['x'];
                $length = &$slug['length'];
                $tail   = &$slug['tail'];
                $head   = &$slug['head'];
                $delay  = &$slug['delay'];

                /**
                 * Reset slug if tail reached the end of screen
                 */
                if($y - $length > $height){
                    $y      = 1;
                    $x      = mt_rand(1,$width);
                    $tail   = array();
                    $length = mt_rand(max(ceil($maxLength / 2),3), $maxLength);
                    $delay  = mt_rand(0, $totalCount);
                }

                /**
                 * Advance to next position each few iterations
                 */
                if(mt_rand(1,3)){
                    // do nothing if there is a delay planned
                    if($delay > 0){
                        $delay--;
                        continue;
                    }

                    // store tail
                    $tail[] = ''.$head;

                    // render head
                    if($y <= $height){
                        $console->writeAt($head,$x,$y, Color::WHITE);
                    }

                    // randomize head
                    $head = $chars[mt_rand(0,$charEnd)];

                    // trim tail
                    if(count($tail) > $length){
                        // remove element from tail
                        array_shift($tail);

                        if($y > $length){
                            // erase trimmed tail segment
                            $console->writeAt(' ',$x, $y - $length);
                        }
                    }

                    // render tail
                    $tailCount = count($tail);
                    $half = ceil( ($length-1) / 2) - 1;
                    for($tailY = 0; $tailY < $tailCount -1; $tailY++){
                        $char = $tail[$tailY];
                        $pos  = $y - $tailCount + 1 + $tailY;

                        if($pos > 0 && $pos <= $height) {
                            $color = ($tailY > $half) ? Color::LIGHT_GREEN : Color::GREEN;
                            $console->writeAt($char,$x,$pos, $color);
                        }
                    }

                    // advance position
                    $y++;
                }

            }
            usleep(200000 - ($speed * 20000));
            $console->showCursor();
        }while(true);
    }

    /**
     * @return Console
     */
    public function getConsole(){
        return $this->getServiceLocator()->get('console');
    }
}
