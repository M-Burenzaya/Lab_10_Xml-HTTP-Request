let data;
let detailLink;
let roomname;

function SearchTarget() {
    const formData = new FormData(document.getElementById("SearchForm"));

    var xhttp = new XMLHttpRequest();                                                   //XMLHttpRequest object
    var targetValue = document.getElementById("target").value;                          //Хэрэглэгчийн бичсэн утга
    
    if (targetValue.trim() !== '') {
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    try {
                        data = JSON.parse(this.responseText);
                        
                        if (Array.isArray(data) && data.length > 0) {
                          data.forEach(item => {console.log(`ItemID: ${item.ItemID}, ItemName: ${item.ItemName}, RoomID: ${item.RoomID}`);});
                          DetailsButton();
                          
                          //window.alert("Өгөгдөл амжилттай илгээгдлээ: " + this.responseText);
                          //document.querySelector('#result').innerHTML = this.responseText;
                          
                        } else {
                            window.alert("Өгөгдлийн сангаас олсонгүй.");
                        }
                    } catch (error) {
                        window.alert("JSON дата биш байна.");
                    }
                } else {
                    window.alert("Алдаатай хариу ирлээ:" + this.statusText);
                }
            }
        };
        xhttp.open("GET", 'searchdata.php?target='+encodeURIComponent(targetValue), true);  //Header GET, Query-г URL дээр залгана
        xhttp.send();                                                                       //Хүсэлт илгээнэ
    } else {
        window.alert("Хайх утга оруулна уу.");
    }
}

function DetailsButton() {
    document.getElementById("SearchDiv").innerHTML = '';
    document.getElementById("DetailDiv").innerHTML = '<button type="button" id="DetailBtn" onclick="GetDetail()">Дэлгэрэнгүй</button>';
    document.getElementById("Title").innerHTML = '<h2>Өгөгдлийн сан дахь ахуйн эд зүйлсийн мэдээллээс олдлоо</h2>';
}
function BackButton() {
    document.getElementById("DetailDiv").innerHTML = '';
    document.getElementById("ExitDiv").innerHTML = '<button type="button" id="DetailBtn" onclick="GetItem()">Буцах</button>';
    document.getElementById("Title").innerHTML = '<h2>Өгөгдлийн сан дахь ахуйн эд зүйлсийн мэдээллээс авсан дэлгэрэнгүй</h2>';
    //const iframeHTML = ` <iframe width="420" height="315" src="src="${detailLink}" frameborder="0" allowfullscreen></iframe>`;
    //document.getElementById("result").innerHTML = iframeHTML;
    document.getElementById("resultlink").innerHTML = detailLink;
    document.getElementById("RoomName").innerHTML = roomname;
}
function GetItem() {
    document.getElementById("ExitDiv").innerHTML = '';
    document.getElementById("SearchDiv").innerHTML = '<button type="button" id="SearchBtn" onclick="SearchTarget()">Хайх</button>';
    document.getElementById("Title").innerHTML = '<h2>Өгөгдлийн сан дахь ахуйн эд зүйлсийн мэдээллээс хайлт хийх</h2>';
    document.getElementById("result").innerHTML = '';
    document.getElementById("RoomName").innerHTML = '';
    document.getElementById("RoomName").innerHTML = '';
}

function GetDetail() {
    const parsedData = data;
    const ItemID = parsedData[0].ItemID;
    const RoomID = parsedData[0].RoomID;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                try {
                    const detailData = JSON.parse(this.responseText);

                    const itemData = detailData.ItemData;
                    const roomData = detailData.RoomData;

                    console.log("ItemData:", itemData);
                    console.log("RoomData:", roomData);

                    if (itemData.length > 0) {
                        detailLink = itemData[0].Detail;
                        roomname = roomData[0].RoomName;
                        
                        BackButton();
                        //console.log("Detail Link:", detailLink);
                    } else {
                        window.alert("Дэлгэрэнгүй мэдээлэл олдсонгүй.");
                    }
                } catch (error) {
                    window.alert("JSON датаг задлахад алдаа гарлаа.");
                }
            } else {
                window.alert("Датаг хүлээж авахад алдаа гарлаа: " + this.statusText);
            }
        }
    };

    xhttp.open("GET", `detail.php?ItemID=${ItemID}&RoomID=${RoomID}`, true);
    xhttp.send();
}