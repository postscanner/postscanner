import requests
import lxml.html
import json
import sys

def autoComplete(city):
    data = requests.get("http://www.spsr.ru/ru/service/calculator?q=/spsr/cc_autocomplete/" + city)
    data = json.loads(data.text)[0]
    return {"name": data['label'], "id": data['id']}


def getDim(x):
    return int((float(x)**(1/3)) * 100)

originalCityName = sys.argv[1]
deliveryCityName = sys.argv[2]
weight = sys.argv[3]
volume = sys.argv[4]
value = 0
if len(sys.argv) >= 6:
    value = sys.argv[5]
else:
    value = 0

originalCity = autoComplete(originalCityName)
deliveryCity = autoComplete(deliveryCityName)

url = "http://www.spsr.ru/ru/system/ajax"
r = requests.get("http://www.spsr.ru/ru/service/calculator")
calc_form = lxml.html.fromstring(r.text).forms[-1].fields
calc_form["from_ship"] = originalCity["name"]
calc_form["from_ship_id"] = originalCity["id"]
calc_form["to_send"] = deliveryCity["name"]
calc_form["to_send_id"] = deliveryCity["id"]
calc_form["weight"] = weight
calc_form["width"] = calc_form["_length"] = calc_form["height"] = str(getDim(volume))
calc_form["cost"] = str(value)
payload = { }
for x in calc_form:
    payload[x] = calc_form[x]
#payload = "from_ship_region_id=&form_build_id=form-Mc-g8xQOyleWEgC-T182oWlRAA7S3ISGLY2GqoOt1vM&form_id=spsr_calculator_form&from_ship=%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0+%2F+%D0%9C%D0%BE%D1%81%D0%BA%D0%BE%D0%B2%D1%81%D0%BA%D0%B0%D1%8F+%D0%BE%D0%B1%D0%BB.&from_ship_id=992&from_ship_owner_id=&to_send=%D0%A1%D0%B0%D0%BD%D0%BA%D1%82-%D0%9F%D0%B5%D1%82%D0%B5%D1%80%D0%B1%D1%83%D1%80%D0%B3+%2F+%D0%9B%D0%B5%D0%BD%D0%B8%D0%BD%D0%B3%D1%80%D0%B0%D0%B4%D1%81%D0%BA%D0%B0%D1%8F+%D0%BE%D0%B1%D0%BB.&to_send_id=893&to_send_owner_id=&weight=1&EncloseType=15&width=1&_length=1&height=1&cost=0&type=0&login=&pass=&icn=&new=1&sid=&_triggering_element_name=submit&ajax_html_ids%5B%5D=facebook-jssdk&ajax_html_ids%5B%5D=bug.surrogate.18&ajax_html_ids%5B%5D=skip-link&ajax_html_ids%5B%5D=wrapper&ajax_html_ids%5B%5D=logo_text&ajax_html_ids%5B%5D=phone&ajax_html_ids%5B%5D=phone_text&ajax_html_ids%5B%5D=nav&ajax_html_ids%5B%5D=servise&ajax_html_ids%5B%5D=search_wrap&ajax_html_ids%5B%5D=search_left&ajax_html_ids%5B%5D=search_right&ajax_html_ids%5B%5D=search_center&ajax_html_ids%5B%5D=ya-site-form0&ajax_html_ids%5B%5D=lang&ajax_html_ids%5B%5D=breadcrumbs&ajax_html_ids%5B%5D=aik_bokpanel&ajax_html_ids%5B%5D=left_services&ajax_html_ids%5B%5D=page_content&ajax_html_ids%5B%5D=block-system-main&ajax_html_ids%5B%5D=node-2&ajax_html_ids%5B%5D=calculator_form&ajax_html_ids%5B%5D=spsr-calculator-form&ajax_html_ids%5B%5D=edit-from-ship-region-id&ajax_html_ids%5B%5D=calculator&ajax_html_ids%5B%5D=content_txt1&ajax_html_ids%5B%5D=edit-from-ship&ajax_html_ids%5B%5D=edit-from-ship-id&ajax_html_ids%5B%5D=edit-from-city-owner-id&ajax_html_ids%5B%5D=edit-to-send&ajax_html_ids%5B%5D=edit-to-send-id&ajax_html_ids%5B%5D=edit-to-city-owner-id&ajax_html_ids%5B%5D=content_txt2&ajax_html_ids%5B%5D=edit-weight&ajax_html_ids%5B%5D=edit-enclosetype&ajax_html_ids%5B%5D=edit-width&ajax_html_ids%5B%5D=edit-length&ajax_html_ids%5B%5D=edit-height&ajax_html_ids%5B%5D=content_txt3&ajax_html_ids%5B%5D=edit-cost&ajax_html_ids%5B%5D=edit-type&ajax_html_ids%5B%5D=edit-type-0&ajax_html_ids%5B%5D=edit-type-1&ajax_html_ids%5B%5D=edit-sms&ajax_html_ids%5B%5D=edit-sms-reciever&ajax_html_ids%5B%5D=edit-pre-notification&ajax_html_ids%5B%5D=edit-fee-on-request&ajax_html_ids%5B%5D=edit-payment-of-receiver&ajax_html_ids%5B%5D=edit-by-hand&ajax_html_ids%5B%5D=edit-icd&ajax_html_ids%5B%5D=loginform&ajax_html_ids%5B%5D=loginbuttons&ajax_html_ids%5B%5D=submit&ajax_html_ids%5B%5D=spinner&ajax_html_ids%5B%5D=result&ajax_html_ids%5B%5D=content_txt6&ajax_html_ids%5B%5D=tariffinvoice_number&ajax_html_ids%5B%5D=img_loader&ajax_html_ids%5B%5D=tariffinvoice_error&ajax_html_ids%5B%5D=tariffinvoice_result&ajax_html_ids%5B%5D=validation_error&ajax_html_ids%5B%5D=submit_form&ajax_html_ids%5B%5D=bottom-col&ajax_html_ids%5B%5D=bottom-cell&ajax_html_ids%5B%5D=social_button&ajax_page_state%5Btheme%5D=spsr&ajax_page_state%5Btheme_token%5D=bo7KsYk8pfJwoDSqu9F01ht3MUV-hbCAob-l2EliCyI&ajax_page_state%5Bcss%5D%5Bmodules%2Fsystem%2Fsystem.base.css%5D=1&ajax_page_state%5Bcss%5D%5Bmodules%2Fsystem%2Fsystem.menus.css%5D=1&ajax_page_state%5Bcss%5D%5Bmodules%2Fsystem%2Fsystem.messages.css%5D=1&ajax_page_state%5Bcss%5D%5Bmodules%2Fsystem%2Fsystem.theme.css%5D=1&ajax_page_state%5Bcss%5D%5Bmisc%2Fui%2Fjquery.ui.core.css%5D=1&ajax_page_state%5Bcss%5D%5Bmisc%2Fui%2Fjquery.ui.theme.css%5D=1&ajax_page_state%5Bcss%5D%5Bmisc%2Fui%2Fjquery.ui.autocomplete.css%5D=1&ajax_page_state%5Bcss%5D%5Bmodules%2Fcomment%2Fcomment.css%5D=1&ajax_page_state%5Bcss%5D%5Bmodules%2Ffield%2Ftheme%2Ffield.css%5D=1&ajax_page_state%5Bcss%5D%5Bmodules%2Fnode%2Fnode.css%5D=1&ajax_page_state%5Bcss%5D%5Bmodules%2Fsearch%2Fsearch.css%5D=1&ajax_page_state%5Bcss%5D%5Bmodules%2Fuser%2Fuser.css%5D=1&ajax_page_state%5Bcss%5D%5Bsites%2Fdefault%2Fmodules%2Fviews%2Fcss%2Fviews.css%5D=1&ajax_page_state%5Bcss%5D%5Bsites%2Fdefault%2Fmodules%2Fctools%2Fcss%2Fctools.css%5D=1&ajax_page_state%5Bcss%5D%5Bthemes%2Fspsr%2Fcss%2Fcusel.css%5D=1&ajax_page_state%5Bcss%5D%5Bthemes%2Fspsr%2Fcss%2FjScrollPane.css%5D=1&ajax_page_state%5Bcss%5D%5Bthemes%2Fspsr%2Fjs%2Fdatepicker%2Fcss%2Fstart%2Fdatepicker.css%5D=1&ajax_page_state%5Bcss%5D%5Bthemes%2Fspsr%2Fcss%2Fprint.css%5D=1&ajax_page_state%5Bcss%5D%5Bthemes%2Fspsr%2Fcss%2Fie.css%5D=1&ajax_page_state%5Bcss%5D%5Bthemes%2Fspsr%2Fcss%2Fie6.css%5D=1&ajax_page_state%5Bjs%5D%5Bmisc%2Fjquery.js%5D=1&ajax_page_state%5Bjs%5D%5Bmisc%2Fjquery.once.js%5D=1&ajax_page_state%5Bjs%5D%5Bmisc%2Fdrupal.js%5D=1&ajax_page_state%5Bjs%5D%5Bmisc%2Fui%2Fjquery.ui.core.min.js%5D=1&ajax_page_state%5Bjs%5D%5Bmisc%2Fui%2Fjquery.ui.widget.min.js%5D=1&ajax_page_state%5Bjs%5D%5Bmisc%2Fui%2Fjquery.ui.position.min.js%5D=1&ajax_page_state%5Bjs%5D%5Bmisc%2Fui%2Fjquery.ui.autocomplete.min.js%5D=1&ajax_page_state%5Bjs%5D%5Bmisc%2Fjquery.cookie.js%5D=1&ajax_page_state%5Bjs%5D%5Bmisc%2Fjquery.form.js%5D=1&ajax_page_state%5Bjs%5D%5Bmisc%2Fajax.js%5D=1&ajax_page_state%5Bjs%5D%5Bpublic%3A%2F%2Flanguages%2Fru_QOIkwAfr959ADpC8iJkvhIvcnmsDYufEaiCZiLjmiVI.js%5D=1&ajax_page_state%5Bjs%5D%5Bsites%2Fdefault%2Fmodules%2Fspsr%2Fspsr_cc.js%5D=1&ajax_page_state%5Bjs%5D%5Bsites%2Fdefault%2Fmodules%2Fspsr%2Fspin.js%5D=1&ajax_page_state%5Bjs%5D%5Bsites%2Fdefault%2Fmodules%2Fspsr%2Fcookies.js%5D=1&ajax_page_state%5Bjs%5D%5Bsites%2Fdefault%2Fmodules%2Fspsr%2Fspsr_calculator.js%5D=1&ajax_page_state%5Bjs%5D%5Bsites%2Fdefault%2Fmodules%2Fspsr%2Ftariffinvoice.js%5D=1&ajax_page_state%5Bjs%5D%5Bmisc%2Fprogress.js%5D=1&ajax_page_state%5Bjs%5D%5Bthemes%2Fspsr%2Fjs%2Fcusel-min-2.3.1.js%5D=1&ajax_page_state%5Bjs%5D%5Bthemes%2Fspsr%2Fjs%2Fscripts.js%5D=1&ajax_page_state%5Bjs%5D%5Bthemes%2Fspsr%2Fjs%2Fjquery.mousewheel.min.js%5D=1&ajax_page_state%5Bjs%5D%5Bthemes%2Fspsr%2Fjs%2FjScrollPane.js%5D=1&ajax_page_state%5Bjs%5D%5Bthemes%2Fspsr%2Fjs%2Fjquery.backgroundPosition.js%5D=1&ajax_page_state%5Bjs%5D%5Bthemes%2Fspsr%2Fjs%2Fjquery.easing.1.3.js%5D=1&ajax_page_state%5Bjs%5D%5Bthemes%2Fspsr%2Fjs%2Fdatepicker%2Fjs%2Fdatepicker.js%5D=1&ajax_page_state%5Bjs%5D%5Bthemes%2Fspsr%2Fjs%2Fdatepicker%2Fjs%2Fdatepicker_ru.js%5D=1&ajax_page_state%5Bjs%5D%5Bsites%2Fdefault%2Fmodules%2Fviews%2Fjs%2Fjquery.ui.dialog.patch.js%5D=1"

hdr = {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
r = requests.post(url, data = payload, headers=hdr)
r = json.loads(r.text)[1]['data']
for x in lxml.html.fromstring(r).xpath("//table[@class='style_table']/tr"):
    try:
        price = x.find("td[2]/b")
        price = lxml.html.tostring(price).decode('utf-8')[3:]
        time = x.find("td[3]")
        time = lxml.html.tostring(time).decode('utf-8')
        
        tariff = x.find("td[1]").text
        print(json.dumps({ "price": price[:price.find(' ')],
                            "time": time[4:time.find('</')],
                            "condition": tariff,
                            }))

    except:
        pass


