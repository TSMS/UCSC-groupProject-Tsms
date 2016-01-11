<?php

require_once 'DB/dbconfig.php';

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	public function register($uname,$email,$upass,$code,$name)
	{
		try
		{							
			$password = md5($upass);
			$stmt = $this->conn->prepare("INSERT INTO users(id,username,password,email,name,nic,joined, token_code) 
			                                         VALUES('',:user_name,:user_pass,:user_mail,:name,'',NOW(),:active_code)");
			$stmt->bindparam(":user_name",$uname);
			$stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":user_pass",$password);
			$stmt->bindparam(":active_code",$code);
			$stmt->bindparam(":name",$name);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM users WHERE email=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['groups']==2){

					if($userRow['user_approved']=="Y")
					{
						if($userRow['password']==md5($upass))
						{
							$_SESSION['userSession'] = $userRow['id'];
							return true;
						}
						else
						{
							header("Location: index.php?error");
							exit;
						}
					}
					else
					{
						header("Location: index.php?inactive");
						exit;
					}
				}else{
					header("Location: index.php?notuser");
					exit;
				}	
			}
			else
			{
				header("Location: index.php?error");
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
	
	function send_mail($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "ssl";                 
		$mail->Host       = "smtp.gmail.com";      
		$mail->Port       = 465;             
		$mail->AddAddress($email);
		$mail->Username="thusitha.4t@gmail.com";  
		$mail->Password="8206560084it";            
		$mail->SetFrom('thusitha.4t@gmail.com','Thalapalakanada Tea Factory');
		$mail->AddReplyTo("thusitha.4t@gmail.com","Tsms");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}

	function userPermission($userid){	
    try{
        $sql = "SELECT level
                FROM users 
                WHERE id = :userId";
        $s = $this->conn->prepare($sql);
        $s->bindValue(":userId", $userid);
        $s->execute();
        $row=$s->fetch(PDO::FETCH_ASSOC);
        return $row['level'];
    } catch(PDOException $e) {
            error_log("PDOException: " . $e->getMessage());
            return -1;
        }   
	}

	function admin($userid){	
    try{
        $sql = "SELECT level
                FROM users 
                WHERE id = :userId";
        $s = $this->conn->prepare($sql);
        $s->bindValue(":userId", $userid);
        $s->execute();
        $row=$s->fetch(PDO::FETCH_ASSOC);
        if($row['level']=="admin"){
        	return true;	
        }else{
        	return false;
        }
    } catch(PDOException $e) {
            error_log("PDOException: " . $e->getMessage());
            return -1;
        }   
	}
		
}