param (
    [string] $ComputerName = '.'
)

Try  {

  $wmiQuery = "SELECT * FROM AntiVirusProduct" 

      [system.Version]$OSVersion = (Get-WmiObject win32_operatingsystem -computername $ComputerName).version

      IF ($OSVersion -ge [system.version]'6.0.0.0') 
      {
          #Write-host "OS Windows Vista/Server 2008 or newer detected."
          $AntiVirusProducts = Get-WmiObject -Namespace root\SecurityCenter2 -Query $wmiQuery  @psboundparameters # -ErrorVariable myError -ErrorAction 'SilentlyContinue'             
      } 
      Else 
      {
          #Write-host "Windows 2000, 2003, XP detected" 
          $AntiVirusProducts = Get-WmiObject -Namespace "root\SecurityCenter" -Query $wmiQuery  @psboundparameters # -ErrorVariable myError -ErrorAction 'SilentlyContinue'             
      } # end IF ($OSVersion -ge 6.0)


      $count = 0
      $av_data = ''

      Foreach ($AntiVirusProduct in $AntiVirusProducts)

      {

          $productState = $AntiVirusProduct.productState

          # convert to hex, add an additional '0' left if necesarry
          $hex = [Convert]::ToString($productState, 16).PadLeft(6,'0')

          # Substring(int startIndex, int length)  
          $WSC_SECURITY_PROVIDER = $hex.Substring(0,2)
          $WSC_SECURITY_PRODUCT_STATE = $hex.Substring(2,2)
          $WSC_SECURITY_SIGNATURE_STATUS = $hex.Substring(4,2)

          $SECURITY_PROVIDER = switch ($WSC_SECURITY_PROVIDER)
          {
              0  {"NONE"}
              1  {"FIREWALL"}
              2  {"AUTOUPDATE_SETTINGS"}
              4  {"ANTIVIRUS"}
              8  {"ANTISPYWARE"}
              16 {"INTERNET_SETTINGS"}
              32 {"USER_ACCOUNT_CONTROL"}
              64 {"SERVICE"}
              default {"Unknown"}
          }


          $RealTimeProtectionStatus = switch ($WSC_SECURITY_PRODUCT_STATE)
          {
              "00" {"Off"} 
              "01" {"Expired"}
              "10" {"On"}
              "11" {"Snoozed"}
              default {"Unknown"}
          }

          $DefinitionStatus = switch ($WSC_SECURITY_SIGNATURE_STATUS)
          {
              "00" {"Up to Date"}
              "10" {"Outdated"}
              default {"Unknown"}
          }
            

          $count++;

          $av_data += '{ 
                        "Name": "' +  $AntiVirusProduct.__Server + '",
                        "DisplayName": "' + $AntiVirusProduct.displayName + '",
                        "Path": "' + $AntiVirusProduct.pathToSignedProductExe + '",
                        "DefinitionStatus": "' + $DefinitionStatus + '",
                        "RealTimeProductionStatus": "' + $RealTimeProtectionStatus + '"
                        },'
      
      }

    if ($count -gt 1) {
        $av_data = '[' + $av_data.trimend(",") + ']'
    }


      return $av_data

}

Catch  {
  #Something went wrong
  Return "Oops: Something went wrong.<br />$($_.Exception.Message)<br />"
}