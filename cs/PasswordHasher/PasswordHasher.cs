using BCrypt;
using System;
using MySqlConnector;
using Sensitive;

class PasswordHasher{
	static void Main(string[] args){
		if(args.Length != 3) Environment.Exit(0);

		User uInfo = new User(args[0], args[1]);//generate user from username and password entered
		string registerNew = args[2];

		int result = (registerNew == "y") ? uInfo.Register() : uInfo.Login();
		Console.WriteLine(result == 0 ? result : ReadErr(result));//Return error message to PHP or 0 for success
	}

	public struct User{
		public string username;
		public bool userExists;
		public string password;
		public string passwordHash, passwordHashStored;
		const bool admin = false;//force manual granting of admin privileges
		private readonly string connStr = $"Server={DBInfo.ServerName};Database={DBInfo.DBName};User={DBInfo.Username};Password={DBInfo.DBPass}";

		public User(string username, string password){
			this.username = username;
			this.password = password;
			userExists = true;
			passwordHashStored = "";
			passwordHash = BCrypt.Net.BCrypt.EnhancedHashPassword(password);

			string query = $"SELECT Username, Hash FROM Login WHERE Username=\'{username}\'";
			using(var connection = new MySqlConnection(connStr)){
				try{
					connection.Open();	
					Console.WriteLine("Verifying credentials....");
					using(var command = new MySqlCommand(query, connection)){
						using(var reader = command.ExecuteReader()){
							if(!reader.HasRows) userExists = false;
							while(reader.Read()){
								passwordHashStored = reader.GetString(1);
							}
						}				
					}
				}catch(Exception e){
					Console.WriteLine("Failed to select data: " + e.Message);
				}
			}
		}

		public int Login(){
			if(!userExists) return -1;
			bool match = BCrypt.Net.BCrypt.EnhancedVerify(password, passwordHashStored);
			if(!match) return -2;
			Console.WriteLine($"User exists: {userExists} Username: {username} Hash: {passwordHashStored}");	
			return 0;
		}

		public int Register(){
			if(userExists) return -3;
			string query = $"INSERT INTO Login (Username, Hash, Admin) VALUES (@uid, @pwd, @adm)";
			using(var connection = new MySqlConnection(connStr)){
				try{
					connection.Open();	
					Console.WriteLine("Creating New User....");
					using(var command = new MySqlCommand(query, connection)){
						command.Parameters.AddWithValue("@uid", username);
						command.Parameters.AddWithValue("@pwd", passwordHash);
						command.Parameters.AddWithValue("@adm", admin);
						int rowsAffected = command.ExecuteNonQuery();
						if(rowsAffected == 0) Console.WriteLine("Nothing inserted....");
					}
				}catch(Exception e){
					Console.WriteLine("Failed to insert data: " + e.Message);
				}
			}
			return 0;
		}

		public override string ToString(){
			return $"(Username: {username}, Password: {password}, Admin: {admin})";
		}
	}

	private static string ReadErr(int err){
		string msg = "";
		switch(err){
			case -1:
				msg = "Failed to login. User not found...";
				break;
			case -2:
				msg = "Failed to login, password incorrect...";
				break;
			case -3:
				msg = "Failed to register account. Username taken.";
				break;
			default:
				msg = "Unknown Error";
				break;
		}
		return msg; 
	}
}


