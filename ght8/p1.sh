#!/bin/bash   
BASE_URL="https://saurav.tech/NewsAPI/top-headlines"
COUNTRIES=("us" "gb" "in" "au")

# save user’s category selection
input=$QUERY_STRING
IFS=','
read -a CATEGORIES <<< "$input" 

# make GET calls to the (free) NewsAPI and format the response JSON
function api_call(){
        # extract the first 10 lines (first 5 article titles and their corresponding links) and reformat any Unicode punctuation
        RESPONSE=`curl --request GET $@ | jq ".articles[] | .title, .url" | sed 10q | sed -e "s/\"//g; s/[“”’‘]/'/g"`
        echo $RESPONSE;
}

# list the hyperlinked article titles
function display_articles(){
        echo "<ol>"
        echo -e "$@" | sed 's/\n/;/' | while read line; do title=${line%;*}; link=${line#*;}; echo "<li><a href=$link class="text-dark">$title</a></li>"; done
	echo "</ol>"
}

echo "Content-type: text/html"
echo ""
echo "<html><head><title>Global Headlines</title></head><body>"
echo "<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">"

echo "<div class="container" style="margin-top:50px;">"
echo "<div class="table-responsive">"
echo "<table class="table">"

# get all top headlines for each category
for country in "${COUNTRIES[@]}" 
do
	echo "<th scope="col"><img src="https://flagcdn.com/w80/$country.png">&nbsp;${country^^}</th>"
	echo "<tbody>"
	
	for category in "${CATEGORIES[@]}"
	do
        		url="$BASE_URL/category/$category/$country.json"
        		response=`api_call $url`
        		echo "<tr><th scope="row">${category^}</th></tr>"
			echo "<td>`display_articles $response`</td>"
	done
	echo "</tbody>"
done
echo "</table>"
echo "</div>"
echo "</div>"
echo "</body></html>"