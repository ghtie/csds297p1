#!/bin/bash
date=$(cat date.txt | sed 's/-/\//g' )
COMIC_LINKS=("https://www.gocomics.com/garfield/$date" "https://www.gocomics.com/calvinandhobbes/$date" "https://www.gocomics.com/peanuts/$date")
> comiclinks.txt
for link in "${COMIC_LINKS[@]}"
do
	curl $link | grep -n data-image | cut -d= -f 2- >> comiclinks.txt
done