<?php

 $xml=new DomDocument('1.0');

                $processers=$xml->createElement("processors");
				$xml->appendChild($processers);

				echo "<xmp>".$xml->saveXML()."<xmp>";


				