<?php

class CsvProcessor{

    public $data=[];
    
    //instead of a single string, i should make it an array of strings for millions of possible files
    public $file = ["./test.csv" , "./test2.csv"];

    public function readfiles(){

        $i=0;
        //while loop for every file in the array $file
        while (($i < sizeof($this->file))){
            
            //get the pointer of each file
            $pointer = fopen( $this->file[$i], 'r');
            /*this loop fixes the final array,
            If we are in the first file we want everything to be added in the array (else statement)
            In other case, were we are on the second third file etc we check every row in case it is already in our array
            In that case, we calculate the new score and update the array*/
            while (($row = fgetcsv($pointer)) !== false){
                //this if checks if we have passed the first file
                if($i != 0)
                {

                    //if we are not in the first file, check every input if it exists
                    $j=1;   //j starts from 1, because in 0 there is the id,name,score 
                    $bool= false;

                    while($j < sizeof($this->data)){

                        if($row[0] == $this->data[$j][0])
                        {
                            
                            $bool= true;

                            $this->data[$j][2] = $row[2] + $this->data[$j][2];  //calculates the new score

                        }
                        $j++;
                    }

                    if($bool == false && $row[0] != "Id"){  
                        // having the boolean false, means we never found the person in the array, in which case we create a new entry
                        $this->data[] = $row;
                    }

                }else
                //here we are in the first file, so we add everything in the array
                { 
                    $this->data[] = $row;
                }

            }
            $i++;
        }

        $file= fopen("finalScore.csv" , "w");

        //write the new csv file with the final scores
        foreach($this->data as $data){
            
            fputcsv($file, $data);
        }

        fclose($file);
        
    }

    public function SearchForName($name){
        
        $file= fopen("finalScore.csv" , "r");

        //we check the user's input with the file we have created
        while(($row = fgetcsv($file))!== false){

            if($row[1] == $name){

                echo("The final Score for the user ". $name ." with ID:". $row[0] ." is:" .$row[2]."\n");
                
                break;
            }
        }
        echo ("No user found with the name you inserted!");

    }

}


$obj =  new CsvProcessor();
$obj->readfiles();
$name = readline("Please enter the name of the person you are looking:");
$obj->SearchForName($name);


?>