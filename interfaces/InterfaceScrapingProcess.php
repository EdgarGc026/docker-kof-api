<?php
namespace Ifaces;

interface InterfaceScrapingProcess {
 public function sync(): void;
 public function scraping(): void;
 public function single(): void;
}