<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

use App\Batch;
use App\Item;
use App\TransactionDetail;

class TransactionController extends Controller
{
    public function index(){
      return view('log', array(
        'log' => Batch::all()
      ));
    }

    public function getResult(Request $request){
      $flist = $this->Flist(array(
        'support'   => $request->support/100,
        'batch'     => $request->batch,
      ));
      return view('result', array(
        'flist'   => $flist,
        'result'  => $this->result(array(
          'support'     => $request->support/100,
          'confidence'  => $request->confidence/100,
          'batch'       => $request->batch,
          'flist'       => $flist
        ))
      ));
    }

    public function store(Request $request){
      if($request->hasFile('transactions')){
        $batchID = Batch::insertGetId(array());
        $path = $request->file('transactions')->getRealPath();
        $data = (new FastExcel)->import($path);
        $items = array();
        foreach ($data as $key => $value) {
          foreach ($value as $k => $val) {
            if($k != 'TID' && $val != 0){
              $item = Item::where('name', 'like', '%'.$k.'%')->first();
              if(isset($item->id)){
                $id = $item->id;
              }else{
                $id = Item::insertGetId(
                  ['name' => $k]
                );
              }
              array_push($items, array(
                'transaction_id' => $value['TID'],
                'item_id'        => $id,
                'batch_id'       => $batchID,
              ));
            }
          }
        }
        TransactionDetail::insert($items);
      }else{
        return response()->json(['status' => 'error', 'message' => 'check your files']);
      }
      $flist = $this->Flist(array(
        'support'   => $request->support/100,
        'batch'     => $batchID,
      ));
      return view('result', array(
        'flist'   => $flist,
        'result'  => $this->supportConfidence(array(
          'support'     => $request->support/100,
          'confidence'  => $request->confidence/100,
          'batch'       => $batchID,
          'flist'       => $flist
        ))
      ));
    }

    public function FList($data){
      $result       = array();
      $transaction  = count(TransactionDetail::where('batch_id', $data['batch'])->get()->groupBy('transaction_id'));
      $item         = TransactionDetail::where('batch_id', $data['batch'])->get()->groupBy('item_id');
      $support      = $data['support']*$transaction;
      foreach ($item as $key => $value) {
        if(count($value) >= $support){
          array_push($result, array(
            // Nama item
            'item'    => Item::where('id', $key)->first(),
            // jumlah transaksi
            'count'   => count($value),
          ));
        }
      }
      usort($result, function($a, $b) {
          return $a['count'] <=> $b['count'];
      });
      return array_reverse($result);
    }

    public function result($data){
      // query for selecting combination
      // return TransactionDetail::select('transaction_id')->whereIn('item_id',[1,2])->distinct()->count();

      // $result       = array();
      $transaction  = count(TransactionDetail::where('batch_id', $data['batch'])->get()->groupBy('transaction_id'));
      // $item         = TransactionDetail::where('batch_id', $data['batch'])->get()->groupBy('item_id');
      $flist        = $data['flist'];
      $support      = array();
      $confidence   = array();
      $pattern      = array();
      $result       = array();
      foreach ($flist as $key => $value) {
        $tr  = TransactionDetail::select('transaction_id')->where('item_id', $value['item']['id'])->distinct()->get();
        $cb  = array();
        foreach ($tr as $k => $val) {
          $it = TransactionDetail::where('transaction_id', $val['transaction_id'])->orderBy('item_id')->pluck('item_id');
          if(count($it) > 1){
            array_push($cb, $it);
          }
        }
        sort($cb);
        if(isset($cb) && count($cb)){
          array_push($pattern, array(
            'item'        => Item::where('id', $value['item']['id'])->first(),
            'combination' => array_unique($cb)
          ));
        }
      }
      foreach ($pattern as $key => $value) {
        // item id = $value['item']['id']
        foreach ($value['combination'] as $k => $val) {
          // transaksi yang memiliki item sesuai $val
          $count    = count(TransactionDetail::select('transaction_id')->whereIn('item_id', $val)->groupBy('transaction_id')->havingRaw("count('item_id') = ?", [count($val)])->distinct()->get());
          $sup      = $count/$transaction;
          $cnf      = $count/count(TransactionDetail::select('transaction_id')->where('item_id', $value['item']['id'])->distinct()->get());
          $counter  = 1;
          foreach ($val as $idx => $v) {
            $counter = $counter * count(TransactionDetail::select('transaction_id')->where('item_id', $v)->distinct()->get());
          }
          if($data['support'] <= $sup && $data['confidence'] <= $cnf){
            array_push($result, array(
              'pattern'     => $val,
              'count'       => $count,
              'support'     => $sup,
              'confidence'  => $cnf,
              'liftratio'   => $sup/$counter
            ));
          }
        }
      }
      return $result;
    }
}
