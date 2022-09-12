<?php

namespace App\Filters\v1;

use App\Filters\ApiFilter;

class CharacterFilter extends ApiFilter {
 protected $safeParams = ['name' => ['eq', 'gt', 'lt']];

 protected $columnMap = ['name' => 'name'];

 protected $operatorMap = [
  'eq' => '=',
  'lt' => '<',
  'lte' => '<=',
  'gt' => '>',
  'gte' => '>=', //in like
 ];

/*  public function transform(Request $request): array{
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
} */
}