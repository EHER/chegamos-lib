#!/bin/sh

curl -X GET -# -H "Accept: application/json" -H "Authorization: Bearer ${ACCESS_TOKEN}" "https://api.apontador.com.br/v2/places/A839ALF5" -o place.json
curl -X GET -# -H "Accept: application/json" -H "Authorization: Bearer ${ACCESS_TOKEN}" "https://api.apontador.com.br/v2/places?q=gpaci" -o search.json
curl -X GET -# -H "Accept: application/json" -H "Authorization: Bearer ${ACCESS_TOKEN}" "https://api.apontador.com.br/v2/places?q=gpaci&location.lat=-23.57361&location.lng=-46.58861&sort=location.distance" -o searchByPoint.json
curl -X GET -# -H "Accept: application/json" -H "Authorization: Bearer ${ACCESS_TOKEN}" "https://api.apontador.com.br/v2/places?q=gpaci&fq=address.city:sorocaba%20AND%20address.district:%22Jardim%20Paulistano%22" -o searchByAddress.json

