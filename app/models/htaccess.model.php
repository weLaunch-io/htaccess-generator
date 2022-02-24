<?php
namespace models;

class htaccesses implements \models\modelInterface {

	protected $app;
	protected $db;
	protected $gump;

	function __construct($app) 
	{
		$this->app = $app;
		$this->db = $app->db;
		$this->gump = new \GUMP();
	}

	public function create($db, $database) {
		// $sql = 'CREATE TABLE '.$database.'.`htaccessgenerator` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, `showComments` VARCHAR(3) NOT NULL , `crossOriginRequests` VARCHAR(3) NOT NULL , `crossOriginImages` VARCHAR(3) NOT NULL , `crossOriginWebfonts` VARCHAR(3) NOT NULL , `CrossOriginResourceTiming` VARCHAR(3) NOT NULL , `internetExplorer` VARCHAR(3) NOT NULL , `iframeCookies` VARCHAR(3) NOT NULL , `mediaTypes` VARCHAR(3) NOT NULL , `characterEncoding` VARCHAR(3) NOT NULL , `characterEncodingFiles` VARCHAR(3) NOT NULL , `compression` VARCHAR(3) NOT NULL , `contentTransformation` VARCHAR(3) NOT NULL , `fileConcatentation` VARCHAR(3) NOT NULL , `fileCacheBusting` VARCHAR(3) NOT NULL , `ETags` VARCHAR(3) NOT NULL , `expiresHeader` VARCHAR(3) NOT NULL , `expiresDefault` VARCHAR(3) NOT NULL , `expires` TEXT NOT NULL , `protection` VARCHAR(3) NOT NULL , `protectionName` VARCHAR(255) NOT NULL , `protectionPath` VARCHAR(255) NOT NULL , `protectionUserName` TEXT NOT NULL , `protectionUserPassword` TEXT NOT NULL , `errorPrevention` VARCHAR(3) NOT NULL , `errors` TEXT NOT NULL , `clickjacking` VARCHAR(3) NOT NULL , `CSP` VARCHAR(3) NOT NULL , `fileAccess` VARCHAR(3) NOT NULL , `blockHiddenFiles` VARCHAR(3) NOT NULL , `blockSensitiveInformation` VARCHAR(3) NOT NULL , `HSTS` VARCHAR(3) NOT NULL , `MIMETypeSecurity` VARCHAR(3) NOT NULL , `enableXSSFilter` VARCHAR(3) NOT NULL , `removeXpowered` VARCHAR(3) NOT NULL , `showServerInformation` VARCHAR(3) NOT NULL , `rewriteEngine` VARCHAR(3) NOT NULL , `followSymlinks` VARCHAR(3) NOT NULL , `SymLinksIfOwnerMatch` VARCHAR(3) NOT NULL , `rewriteBase` VARCHAR(255) NOT NULL , `rewriteOptions` VARCHAR(255) NULL , `allowAppropriateSchema` VARCHAR(3) NOT NULL , `forcehttps` VARCHAR(3) NOT NULL , `forcewww` VARCHAR(3) NOT NULL , `customRewriteRules` TEXT NOT NULL , `blockBadBots` VARCHAR(3) NOT NULL , `badBot` VARCHAR(3) NOT NULL , `vulnerabilityScanners` VARCHAR(3) NOT NULL , `chineseSearchEngine` VARCHAR(3) NOT NULL , `russianSearchEngine` INT(3) NOT NULL ) ENGINE = MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;';
		$sql = 'CREATE TABLE IF NOT EXISTS `htaccesses` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `name` varchar(255) NOT NULL,
				  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				  `showComments` varchar(3) NOT NULL,
				  `crossOriginRequests` varchar(3) NOT NULL,
				  `crossOriginImages` varchar(3) NOT NULL,
				  `crossOriginWebfonts` varchar(3) NOT NULL,
				  `CrossOriginResourceTiming` varchar(3) NOT NULL,
				  `internetExplorer` varchar(3) NOT NULL,
				  `iframeCookies` varchar(3) NOT NULL,
				  `mediaTypes` varchar(3) NOT NULL,
				  `characterEncoding` varchar(3) NOT NULL,
				  `characterEncodingFiles` varchar(3) NOT NULL,
				  `compression` varchar(3) NOT NULL,
				  `contentTransformation` varchar(3) NOT NULL,
				  `fileConcatentation` varchar(3) NOT NULL,
				  `fileCacheBusting` varchar(3) NOT NULL,
				  `ETags` varchar(3) NOT NULL,
				  `expiresHeader` varchar(3) NOT NULL,
				  `expiresDefault` varchar(3) NOT NULL,
				  `expires` text NOT NULL,
				  `protection` varchar(3) NOT NULL,
				  `protectionName` varchar(255) NOT NULL,
				  `protectionPath` varchar(255) NOT NULL,
				  `protectionUserName` text NOT NULL,
				  `protectionUserPassword` text NOT NULL,
				  `errorPrevention` varchar(3) NOT NULL,
				  `errors` text NOT NULL,
				  `clickjacking` varchar(3) NOT NULL,
				  `CSP` varchar(3) NOT NULL,
				  `fileAccess` varchar(3) NOT NULL,
				  `blockHiddenFiles` varchar(3) NOT NULL,
				  `blockSensitiveInformation` varchar(3) NOT NULL,
				  `HSTS` varchar(3) NOT NULL,
				  `MIMETypeSecurity` varchar(3) NOT NULL,
				  `enableXSSFilter` varchar(3) NOT NULL,
				  `removeXpowered` varchar(3) NOT NULL,
				  `showServerInformation` varchar(3) NOT NULL,
				  `rewriteEngine` varchar(3) NOT NULL,
				  `followSymlinks` varchar(3) NOT NULL,
				  `SymLinksIfOwnerMatch` varchar(3) NOT NULL,
				  `rewriteBase` varchar(255) NOT NULL,
				  `rewriteOptions` varchar(255) DEFAULT NULL,
				  `allowAppropriateSchema` varchar(3) NOT NULL,
				  `forcehttps` varchar(3) NOT NULL,
				  `forcewww` varchar(3) NOT NULL,
				  `customRewriteRules` text NOT NULL,
				  `blockBadBots` varchar(3) NOT NULL,
				  `badBot` varchar(3) NOT NULL,
				  `vulnerabilityScanners` varchar(3) NOT NULL,
				  `chineseSearchEngine` varchar(3) NOT NULL,
				  `russianSearchEngine` varchar(3) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ';
		try {
			$stmt = $db->prepare($sql);
			$stmt->execute();
			return true;
		} catch(\PDOException $e) {
			throw $e;
		}
	}

	public function insert($data) 
	{
	    $validated = $this->validate($data);
	    if($validated === TRUE){
	    	$sanitized = $this->sanitize($data);
			$sql = "INSERT IGNORE INTO htaccesses (name, showComments, crossOriginRequests, crossOriginImages, crossOriginWebfonts, CrossOriginResourceTiming, internetExplorer, iframeCookies, mediaTypes, characterEncoding, characterEncodingFiles, compression, contentTransformation, fileConcatentation, fileCacheBusting, ETags, expiresHeader, expiresDefault, expires, protection, protectionName, protectionPath, protectionUserName, protectionUserPassword, errorPrevention, errors, clickjacking, CSP, fileAccess, blockHiddenFiles, blockSensitiveInformation, HSTS, MIMETypeSecurity, enableXSSFilter, removeXpowered, showServerInformation, rewriteEngine, followSymlinks, SymLinksIfOwnerMatch, rewriteBase, allowAppropriateSchema, forcehttps, forcewww, customRewriteRules, blockBadBots, badBot, vulnerabilityScanners, chineseSearchEngine, russianSearchEngine) 

					VALUES (:name, :showComments, :crossOriginRequests, :crossOriginImages, :crossOriginWebfonts, :CrossOriginResourceTiming, :internetExplorer, :iframeCookies, :mediaTypes, :characterEncoding, :characterEncodingFiles, :compression, :contentTransformation, :fileConcatentation, :fileCacheBusting, :ETags, :expiresHeader, :expiresDefault, :expires, :protection, :protectionName, :protectionPath, :protectionUserName, :protectionUserPassword, :errorPrevention, :errors, :clickjacking, :CSP, :fileAccess, :blockHiddenFiles, :blockSensitiveInformation, :HSTS, :MIMETypeSecurity, :enableXSSFilter, :removeXpowered, :showServerInformation, :rewriteEngine, :followSymlinks, :SymLinksIfOwnerMatch, :rewriteBase, :allowAppropriateSchema, :forcehttps, :forcewww, :customRewriteRules, :blockBadBots, :badBot, :vulnerabilityScanners, :chineseSearchEngine, :russianSearchEngine) ";
			try {
				$stmt = $this->db->prepare($sql);

				$stmt->bindParam("name", $sanitized['name']);
				$stmt->bindParam("showComments", $sanitized['showComments']);
				$stmt->bindParam("crossOriginRequests", $sanitized['crossOriginRequests']);
				$stmt->bindParam("crossOriginImages", $sanitized['crossOriginImages']);
				$stmt->bindParam("crossOriginWebfonts", $sanitized['crossOriginWebfonts']);
				$stmt->bindParam("CrossOriginResourceTiming", $sanitized['CrossOriginResourceTiming']);
				$stmt->bindParam("internetExplorer", $sanitized['internetExplorer']);
				$stmt->bindParam("iframeCookies", $sanitized['iframeCookies']);
				$stmt->bindParam("mediaTypes", $sanitized['mediaTypes']);
				$stmt->bindParam("characterEncoding", $sanitized['characterEncoding']);
				$stmt->bindParam("characterEncodingFiles", $sanitized['characterEncodingFiles']);
				$stmt->bindParam("compression", $sanitized['compression']);
				$stmt->bindParam("contentTransformation", $sanitized['contentTransformation']);
				$stmt->bindParam("fileConcatentation", $sanitized['fileConcatentation']);
				$stmt->bindParam("fileCacheBusting", $sanitized['fileCacheBusting']);
				$stmt->bindParam("ETags", $sanitized['ETags']);
				$stmt->bindParam("expiresHeader", $sanitized['expiresHeader']);
				$stmt->bindParam("expiresDefault", $sanitized['expiresDefault']);
				$stmt->bindParam("expires", $sanitized['expires']);
				$stmt->bindParam("protection", $sanitized['protection']);
				$stmt->bindParam("protectionName", $sanitized['protectionName']);
				$stmt->bindParam("protectionPath", $sanitized['protectionPath']);
				$stmt->bindParam("protectionUserName", $sanitized['protectionUserName']);
				$stmt->bindParam("protectionUserPassword", $sanitized['protectionUserPassword']);
				$stmt->bindParam("errorPrevention", $sanitized['errorPrevention']);
				$stmt->bindParam("errors", $sanitized['errors']);
				$stmt->bindParam("clickjacking", $sanitized['clickjacking']);
				$stmt->bindParam("CSP", $sanitized['CSP']);
				$stmt->bindParam("fileAccess", $sanitized['fileAccess']);
				$stmt->bindParam("blockHiddenFiles", $sanitized['blockHiddenFiles']);
				$stmt->bindParam("blockSensitiveInformation", $sanitized['blockSensitiveInformation']);
				$stmt->bindParam("HSTS", $sanitized['HSTS']);
				$stmt->bindParam("MIMETypeSecurity", $sanitized['MIMETypeSecurity']);
				$stmt->bindParam("enableXSSFilter", $sanitized['enableXSSFilter']);
				$stmt->bindParam("removeXpowered", $sanitized['removeXpowered']);
				$stmt->bindParam("showServerInformation", $sanitized['showServerInformation']);
				$stmt->bindParam("rewriteEngine", $sanitized['rewriteEngine']);
				$stmt->bindParam("followSymlinks", $sanitized['followSymlinks']);
				$stmt->bindParam("SymLinksIfOwnerMatch", $sanitized['SymLinksIfOwnerMatch']);
				$stmt->bindParam("rewriteBase", $sanitized['rewriteBase']);
				$stmt->bindParam("allowAppropriateSchema", $sanitized['allowAppropriateSchema']);
				$stmt->bindParam("forcehttps", $sanitized['forcehttps']);
				$stmt->bindParam("forcewww", $sanitized['forcewww']);
				$stmt->bindParam("customRewriteRules", $sanitized['customRewriteRules']);
				$stmt->bindParam("blockBadBots", $sanitized['blockBadBots']);
				$stmt->bindParam("badBot", $sanitized['badBot']);
				$stmt->bindParam("vulnerabilityScanners", $sanitized['vulnerabilityScanners']);
				$stmt->bindParam("chineseSearchEngine", $sanitized['chineseSearchEngine']);
				$stmt->bindParam("russianSearchEngine", $sanitized['russianSearchEngine']);
				$stmt->execute();
				$return['id'] = $this->db->lastInsertId();

				
				return $return;
			} catch(PDOException $e) {
				throw $e;
			}
	    }
	}

	public function validate($data)
	{
  		$rules = array(
	    	'name'                  		=> 'required',
			'showComments'                  => 'required|contains,yes no',
			'crossOriginRequests'           => 'required|contains,yes no',
			'crossOriginImages'             => 'required|contains,yes no',
			'crossOriginWebfonts'           => 'required|contains,yes no',
			'CrossOriginResourceTiming'     => 'required|contains,yes no',
			'internetExplorer'              => 'required|contains,yes no',
			'iframeCookies'                 => 'required|contains,yes no',
			'mediaTypes'                    => 'required|contains,yes no',
			'characterEncoding'             => 'required|contains,yes no',
			'characterEncodingFiles'        => 'required|contains,yes no',
			'compression'                   => 'required|contains,yes no',
			'contentTransformation'         => 'required|contains,yes no',
			'fileConcatentation'            => 'required|contains,yes no',
			'fileCacheBusting'              => 'required|contains,yes no',
			'ETags'                         => 'required|contains,yes no',
			'expiresHeader'                 => 'required|contains,yes no',
			// 'expiresDefault'                => '',
			// 'expires'        	            => 'required',
			'protection'                    => 'required|contains,yes no',
			// 'protectionName'                => '',
			// 'protectionPath'                => '',
			// 'protectionUserName'            => 'required|contains,yes no',
			// 'protectionUserPassword'        => 'required|contains,yes no',
			'errorPrevention'               => 'required|contains,yes no',
			// 'errors'                    	=> 'required',
			'clickjacking'                  => 'required|contains,yes no',
			'CSP'                           => 'contains,yes no',
			'fileAccess'                    => 'required|contains,yes no',
			'blockHiddenFiles'              => 'required|contains,yes no',
			'blockSensitiveInformation'     => 'required|contains,yes no',
			'HSTS'                          => 'required|contains,yes no',
			'MIMETypeSecurity'              => 'required|contains,yes no',
			'enableXSSFilter'               => 'required|contains,yes no',
			'removeXpowered'                => 'required|contains,yes no',
			'showServerInformation'         => 'required|contains,yes no',
			'rewriteEngine'                 => 'required|contains,yes no',
			'followSymlinks'                => 'required|contains,yes no',
			'SymLinksIfOwnerMatch'          => 'required|contains,yes no',
			'rewriteBase'                   => 'required',
			// 'rewriteOptions'                => 'required|contains,yes no',
			'allowAppropriateSchema'        => 'required|contains,yes no',
			'forcehttps'                    => 'required|contains,yes no',
			'forcewww'                      => 'required|contains,yes no',
			// 'customRewriteRules'      		=> 'required',
			'blockBadBots'                  => 'required|contains,yes no',
			'badBot'                        => 'contains,yes no',
			'vulnerabilityScanners'         => 'contains,yes no',
			'chineseSearchEngine'           => 'contains,yes no',
			'russianSearchEngine'           => 'contains,yes no',
	    );

	    $validated = $this->gump->validate(
	      $data, $rules
	    );  

	    if($validated !== TRUE)
	    {
	    	throw new \Exception($this->gump->get_readable_errors(true));
    	}
    	return true;
	}

	public function sanitize($data)
	{
		$filter = array(
	    	'name'                  		=> 'sanitize_string',
			'showComments'                  => 'sanitize_string',
			'crossOriginRequests'           => 'sanitize_string',
			'crossOriginImages'             => 'sanitize_string',
			'crossOriginWebfonts'           => 'sanitize_string',
			'CrossOriginResourceTiming'     => 'sanitize_string',
			'internetExplorer'              => 'sanitize_string',
			'iframeCookies'                 => 'sanitize_string',
			'mediaTypes'                    => 'sanitize_string',
			'characterEncoding'             => 'sanitize_string',
			'characterEncodingFiles'        => 'sanitize_string',
			'compression'                   => 'sanitize_string',
			'contentTransformation'         => 'sanitize_string',
			'fileConcatentation'            => 'sanitize_string',
			'fileCacheBusting'              => 'sanitize_string',
			'ETags'                         => 'sanitize_string',
			'expiresHeader'                 => 'sanitize_string',
			'expiresDefault'                => 'sanitize_string',
			'expires'             	        => 'sanitize_string|json_encode',
			'protection'                    => 'sanitize_string',
			'protectionName'                => 'sanitize_string',
			'protectionPath'                => 'sanitize_string',
			'protectionUserName'            => 'sanitize_string|json_encode',
			'protectionUserPassword'        => 'sanitize_string|json_encode',
			'errorPrevention'               => 'sanitize_string',
			'errors'                     	=> 'json_encode',
			'clickjacking'                  => 'sanitize_string',
			'CSP'                           => 'sanitize_string',
			'fileAccess'                    => 'sanitize_string',
			'blockHiddenFiles'              => 'sanitize_string',
			'blockSensitiveInformation'     => 'sanitize_string',
			'HSTS'                          => 'sanitize_string',
			'MIMETypeSecurity'              => 'sanitize_string',
			'enableXSSFilter'               => 'sanitize_string',
			'removeXpowered'                => 'sanitize_string',
			'showServerInformation'         => 'sanitize_string',
			'rewriteEngine'                 => 'sanitize_string',
			'followSymlinks'                => 'sanitize_string',
			'SymLinksIfOwnerMatch'          => 'sanitize_string',
			'rewriteBase'                   => 'sanitize_string',
			// 'rewriteOptions'                => 'sanitize_string',
			'allowAppropriateSchema'        => 'sanitize_string',
			'forcehttps'                    => 'sanitize_string',
			'forcewww'                      => 'sanitize_string',
			'customRewriteRules'      		=> 'sanitize_string|json_encode',
			'blockBadBots'                  => 'sanitize_string',
			'badBot'                        => 'sanitize_string',
			'vulnerabilityScanners'         => 'sanitize_string',
			'chineseSearchEngine'           => 'sanitize_string',
			'russianSearchEngine'           => 'sanitize_string',
		);

		$sanitized = $this->gump->filter($data, $filter);
		return $sanitized;
	}



	public function update($data, $id)
	{

	} 

	public function delete($id)
	{
		$sql = "DELETE FROM htaccesses WHERE id = :id;";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam("id", $id);
			$return = $stmt->execute();
			return $return;
		} catch(\PDOException $e) {
			throw $e;
		}
	} 

	public function getAll()
	{
		$sql = "SELECT * FROM htaccesses ORDER BY date;";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			return $data;
		} catch(\PDOException $e) {
			throw $e;
		}
	} 

	public function getHtaccess($id)
	{
		$sql = "SELECT * FROM htaccesses WHERE id = :id;";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$data = $stmt->fetch(\PDO::FETCH_ASSOC);
			return $data;
		} catch(\PDOException $e) {
			throw $e;
		}
	}
}