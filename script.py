import requests

url = "http://www.omdbapi.com/"
api_key = "aac5a3dc"
search_query = "fast"

params = {
    "apikey": api_key,
    "s": search_query,
}

response = requests.get(url, params=params)

if response.status_code == 200:
    json_response = response.json()
    if json_response["Response"] == "True":
        search_results = json_response["Search"]
        print(search_results)
else:
    print("Error:", response.status_code)
