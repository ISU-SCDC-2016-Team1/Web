import gitlab
import sys
gl = gitlab.Gitlab('http://192.168.1.4/', 'yU8zf7Tuy3Q2SHGh3kdS')
gl.auth()
user_data = {'email': sys.argv[1], 'username': sys.argv[2], 'name': sys.argv[3], 'password': sys.argv[4], 'confirm': "no"}
user = gl.users.create(user_data)
print("Reminder: Do NOT remove GitLab green-team user \"Jen\"")
