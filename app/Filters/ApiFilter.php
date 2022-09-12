<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter {
 protected $safeParams = [];

 protected $columnMap = [];

 protected $operatorMap = [];

 public function transform(Request $request): array{
  $eloQuery = [];

  foreach ($this->safeParams as $param => $operators) {
   //[name => [eq, gt, lt]]
   $query = $request->query($param); // name

   if (!isset($query)) {
    continue;
   }
   // column = name  == name ? true : false
   $column = $this->columnMap[$param] ?? $param;

   foreach ($operators as $operator) {
    //[eq, gt, lt]
    if (isset($query[$operator])) {
     $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]]; // [name, eq => =, eq => =]
    }
   }
  }

  return $eloQuery;
 }
}