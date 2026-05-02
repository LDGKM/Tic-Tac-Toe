<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Tic_Tac_ToeController extends Controller
{
    public function innit(){
        session([
            "a_commence"=>true,
            "dernier_signe"=>"O",
            "case"=>[
                [
                    "case1"=>[false," "] ,
                    "case2"=>[false," "] ,
                    "case3"=>[false," "] 
                ],

                [
                    "case4"=>[false," "] ,
                    "case5"=>[false," "] ,
                    "case6"=>[false," "] 
                ],

                [
                    "case7"=>[false," "] ,
                    "case8"=>[false," "] ,
                    "case9"=>[false," "]  
                ]
            
            ],
            'gagne'=>'En cours'
        ]);
    }

    public function index(){
        if(!session()->has("a_commence")){
            $this->innit();
        }

        $case=session('case');
        $gagne=session('gagne');
        return view('tic_tac_toe.index',compact('case','gagne'));
    }

    public function marquer(Request $request){
        $d_s=session('dernier_signe');
        $dernier_signe= $d_s=="O" ? 'X':'O';
        session(["dernier_signe"=>$dernier_signe]);
        $case=session('case');
        
        if($request->case=='case1' || $request->case=='case2' || $request->case=='case3'){
            $case[0][$request->case]=[true,$dernier_signe];
        
            session(['case'=>$case]);

        }

        else if($request->case=='case4' || $request->case=='case5' || $request->case=='case6'){
            $case[1][$request->case]=[true,$dernier_signe];
            
            session(['case'=>$case]);

            
        }

        else{
            $case[2][$request->case]=[true,$dernier_signe];
            session(['case'=>$case]);
        }
        
        $this->gagner();

        return redirect()->route('jeu.index');

    }

    public function reinitialiser(){
        $this->innit();

        return redirect()->route('jeu.index');
    }

    public function gagner(){
        $case=session('case');
        $case1=$case[0]['case1'];
        $case2=$case[0]['case2'];
        $case3=$case[0]['case3'];
        $case4=$case[1]['case4'];
        $case5=$case[1]['case5'];
        $case6=$case[1]['case6'];
        $case7=$case[2]['case7'];
        $case8=$case[2]['case8'];
        $case9=$case[2]['case9'];

        $tabCase=[
            $case1[1],
            $case2[1],
            $case3[1],
            $case4[1],
            $case5[1],
            $case6[1],
            $case7[1],
            $case8[1],
            $case9[1]
        ];

        if(
        (($case1==$case2 && $case2==$case3) && 
        ($case1[0] && $case2[0]&& $case3[0] ))

        || 

        (($case4==$case5 && $case5==$case6)
            && 
        ($case4[0] && $case5[0]&& $case6[0] ))

        || 

        (($case7==$case8 && $case8==$case9)
            && 
        ($case7[0] && $case8[0]&& $case9[0] ))

        || 

        (($case1==$case4 && $case4==$case7)
            && 
        ($case1[0] && $case4[0]&& $case7[0] ))

        || 

        (($case2==$case5 && $case5==$case8)
            && 
        ($case2[0] && $case5[0]&& $case8[0] ))

        || 

        (($case3==$case6 && $case6==$case9)
            && 
        ($case3[0] && $case6[0]&& $case9[0] ))

        || 
        (($case1==$case5 && $case5==$case9)
            && 
        ($case1[0] && $case5[0]&& $case9[0] ))

        || 

        (($case3==$case5 && $case5==$case7)
            && 
        ($case3[0] && $case5[0]&& $case7[0] ))
    )

        {
            session(["gagne"=>"Victoire"]);
            return;
        }

        $egalite=true;
        foreach ($tabCase as $t) {
            if($t==" ") $egalite=false;
        }

        $egalite? session(["gagne"=>"Egalité"]):session(["gagne"=>"En cours"]);
    }
    
}
