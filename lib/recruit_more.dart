import 'package:flutter/material.dart';
import 'package:percent_indicator/linear_percent_indicator.dart';
import 'package:solquiz_2/appbar_more.dart';
import 'package:solquiz_2/predict.dart';
import 'package:solquiz_2/recruit.dart';

import 'board.dart';
import 'db/tb_solar_board.dart';
import 'db/tb_solar_comment.dart';
import 'mainPage.dart';
import 'myPage.dart';
import 'package:percent_indicator/percent_indicator.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:flutter_secure_storage/flutter_secure_storage.dart';
import 'package:flutter/services.dart';

class RecruitMore extends StatefulWidget {
  const RecruitMore({super.key});

  @override
  State<RecruitMore> createState() => _RecruitMoreState();
}

class _RecruitMoreState extends State<RecruitMore> {
  final String _url = 'http://10.0.2.2:3000/recruitsql/bselect'; // 서버 URL
  List<RecruitBoards> _recruit_boards = []; // Boards 객체 리스트
  String _error = '';
  var index = 0;

  int idx = 0;

  final storage = FlutterSecureStorage();
  dynamic userInfo = '';

  @override
  void initState() {
    super.initState();
    _asyncMethod();
    _sendQuery(); // 위젯에서 받은 SQL 쿼리를 사용합니다.
    _recruit_more();
  }

  _asyncMethod() async {
    // read 함수로 key값에 맞는 정보를 불러오고 데이터타입은 String 타입
    // 데이터가 없을때는 null을 반환
    userInfo = await storage.read(key:'login');
    userInfo = json.decode(userInfo);

    if (userInfo != null) {
      print('모집게시판 상세 페이지 _asyncMethod userInfo : ' + userInfo);
      // {"id":"apple","pw":"banana"}
      // Navigator.pushNamed(context, '/navigationbar');
    }
  }

  Future<void> _sendQuery() async {
    try {
      final response = await http.post(
        Uri.parse(_url),
        headers: {
          'Content-Type': 'application/json',
        },
      );

      if (response.statusCode == 200) {
        final dynamic jsonResponse = json.decode(response.body);
        print("연결 성공");
        print(jsonResponse);

        if (jsonResponse is Map<String, dynamic>) {
          // 단일 객체인 경우
          final recruit_boards = RecruitBoards.fromJson(jsonResponse);
          setState(() {
            _recruit_boards = [recruit_boards];
            print(_recruit_boards[0]);
          });
        } else if (jsonResponse is List) {
          // 배열인 경우
          final recruit_boards = jsonResponse.map((data) {
            if (data is Map<String, dynamic>) {
              return RecruitBoards.fromJson(data);
            } else {
              return null; // 데이터가 올바른 형식이 아닌 경우
            }
          }).whereType<RecruitBoards>().toList();

          setState(() {
            _recruit_boards = recruit_boards;
            print(_recruit_boards);
          });
        } else {
          setState(() {
            _error = 'Unexpected JSON format';
          });
        }
      } else {
        setState(() {
          _error = 'Failed to execute query';
        });
      }
    } catch (e) {
      setState(() {
        _error = 'Error: $e';
      });
    }
  }

  List<Widget> pageList = [
    Board(),
    Predict(),
    SolarEnv(),
    Recruit(),
    MyPage()];

  final List<RecruitMore> RecruitmoreList = <RecruitMore>[];

  // 참여현황 리스트 띄우기
  final String _url2 = 'http://10.0.2.2:3000/recruit/recruitmore';
  List<RecruitComment> _recruitcomment = [];

  Future<void> _recruit_more() async {
    print('${idx}');
    try {
      final response2 = await http.post(Uri.parse(_url2),
        headers: {'Content-Type': 'application/json'},
        body: json.encode({'idx': '${idx}'})
      );

      if (response2.statusCode == 200) {
        final dynamic jsonResponse = json.decode(response2.body);
        print("모집 게시판 더보기 페이지 연결 성공");


        if (jsonResponse is Map<String, dynamic>) {
          // 단일 객체인 경우
          final recruitcomment = RecruitComment.fromJson(jsonResponse);
          setState(() {
            _recruitcomment = [recruitcomment];
            print('단일 객체인 경우 ${_recruitcomment[0].PLACE}');
          });
        } else if (jsonResponse is List) {
          // 배열인 경우
          final recruitcomment = jsonResponse.map((data) {
            if (data is Map<String, dynamic>) {
              return RecruitComment.fromJson(data);
            } else {
              return null; // 데이터가 올바른 형식이 아닌 경우
            }
          }).whereType<RecruitComment>().toList();

          setState(() {
            _recruitcomment = recruitcomment;
            print('_recruitcomment을 뽑아보자 ${_recruitcomment}');
            print('_recruitcomment[0]을 뽑아보자 ${_recruitcomment[0]}');
            

          });
        }
      }
    } catch (e) {
      print(e);
    }
  }


  @override
  Widget build(BuildContext context) {
    final arguments = ModalRoute.of(context)!.settings.arguments;
    print('arguments로 받아온 데이터 확인 : ${arguments}');
    idx = arguments as int;

    // print('arguments 로 넘어온 idx : ${idx}');
    // print(_recruit_boards[0].SB_TYPE[idx]);

    return SafeArea(
      child: Scaffold(
        backgroundColor: Colors.white,
        appBar: PreferredSize(
          preferredSize: Size.fromHeight(50),
          child: Appbar2(),
        ),
        body:  _error.isNotEmpty
            ? Center(child: Text(_error),)
            : _recruit_boards.isEmpty
            ? Center(child: CircularProgressIndicator(
              color: Colors.white,
            ))
                : Container(
                    width: double.infinity,
                    margin: EdgeInsets.all(10),
                    padding: EdgeInsets.all(15),
                    decoration: BoxDecoration(
                      color: Colors.white,
                      borderRadius: BorderRadius.circular(12),
                      boxShadow: [
                        BoxShadow(
                          color: Colors.grey.withOpacity(0.5),
                          spreadRadius: 1.5,
                          blurRadius: 5,
                          offset: Offset(0, 3), // 그림자 위치 변경
                        ),
                      ],
                    ),
                    child:
                      Column(
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: [
                          Row(
                            mainAxisAlignment: MainAxisAlignment.spaceBetween,
                            children: [
                              Container(
                                padding: EdgeInsets.fromLTRB(8, 5, 8, 7),
                                decoration: BoxDecoration(
                                  borderRadius: BorderRadius.circular(8),
                                  color: Color(0xffff9201),
                                ),
                                child: Text('모집중', style: TextStyle(color: Colors.white, fontSize: 13,),),
                              ),
                              Row(
                                children: [
                                  IconButton(
                                      onPressed: (){},
                                      icon: Icon(Icons.favorite_border_sharp, color: Colors.black54,),
                                  ),
                                  IconButton(
                                      onPressed: (){},
                                      icon: Icon(Icons.edit, color: Colors.black54,),
                                  ),
                                ],
                              ),
                            ],
                          ),
                          Container(
                            padding: EdgeInsets.all(40),
                              child: Image.asset('image/solQuiz_logo3.png',width: 200,),
                          ),
                          SizedBox(height: 25,),
                          Row(
                            children: [
                              SizedBox(width: 20,),
                              Container(
                                alignment: Alignment.center,
                                child: LinearPercentIndicator(
                                  width: 270,
                                  animation: true,
                                  animationDuration: 100,
                                  lineHeight: 3.0,
                                  // leading: const Text("left"),
                                  // trailing: const Text("right"),
                                  percent: 0.7,
                                  trailing: Text("70.0%", style: TextStyle(fontSize: 15),),
                                  progressColor: Color(0xffff9201),
                                  barRadius: Radius.circular(10),
                                ),
                              ),
                            ],
                          ),
                          SizedBox(height: 20,),
                          Text('[${_recruit_boards[0].SB_TYPE[idx] == 'Inland' ? '내륙' : '해안'}] 발전소 모집',
                            style: TextStyle(fontSize: 22, fontWeight: FontWeight.bold),),
                          SizedBox(height: 10,),
                          Row(
                            mainAxisAlignment: MainAxisAlignment.end,
                            children: [
                              Text('${_recruit_boards[0].PLACE[idx]}',style: TextStyle(fontSize: 20,),),
                              SizedBox(width: 50),
                              ElevatedButton(
                                  style: ElevatedButton.styleFrom(
                                    backgroundColor: Color(0xffff9201),
                                    minimumSize: Size(12, 10),
                                    padding: EdgeInsets.symmetric(horizontal: 13,vertical: 7),
                                    shape: RoundedRectangleBorder(
                                      borderRadius: BorderRadius.circular(5),
                                    ),
                                  ),
                                  child: Text('참여하기',
                                    style: TextStyle(
                                      fontSize: 13,
                                      color: Colors.white,
                                      fontWeight: FontWeight.bold,
                                    ),
                                  ),
                                  onPressed: () => {}
                              ),
                              SizedBox(width: 12,),
                            ],
                          ),
                          SizedBox(height: 20,),
                          Container(width: double.infinity, height: 1, color: Colors.grey[400],),
                          SizedBox(height: 20,),
                          Container(
                            padding: EdgeInsets.all(8),
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Text(
                                    '참여 현황',
                                    style: TextStyle(
                                        fontSize: 17,fontWeight: FontWeight.bold
                                    ),
                                  ),
                                  SizedBox(height: 8,),
                                  // _userContainer(_recruitcomment[0].PLACE[0]!, _recruitcomment[0].SB_TYPE[0]! == 'Inland'? '내륙' : '해안', _recruitcomment[0].PLANT_POWER[0]),
                                  // for(place in _recruitcomment[0].PLACE) _userContainer(region1, region2, env)
                                  // _recruitcomment[0].PLACE
                                  // List.generate(_recruitcomment[0].PLACE.length, (index){
                                  //   return _userContainer(_recruitcomment[0].PLACE, _recruitcomment[0].SB_TYPE, _recruitcomment[0].PLANT_POWER);
                                  // }),
                                  ListView.builder(
                                    shrinkWrap: true,
                                      itemCount: _recruitcomment[0].PLACE[0]?.length,
                                      itemBuilder: (context, index){
                                        return Expanded(child: _userContainer(_recruitcomment[0].PLACE[index]!, _recruitcomment[0].SB_TYPE[index]! == 'Inland'? '내륙' : '해안', _recruitcomment[0].PLANT_POWER[index]));
                                      })

                                ],
                              ),
                          ),

              ],
            ),
        ),
        bottomNavigationBar: SizedBox(
          height: 80,
          child: BottomNavigationBar(
            currentIndex: index,

            onTap: onItemTap,

            type: BottomNavigationBarType.fixed,
            items: [
              BottomNavigationBarItem(icon: Icon(Icons.campaign), label : '공지사항',),
              BottomNavigationBarItem(icon: Icon(Icons.leaderboard), label : '발전량예측',),
              BottomNavigationBarItem(icon: Icon(Icons.wb_sunny_rounded), label : '태양광',),
              BottomNavigationBarItem(icon: Icon(Icons.assignment), label : '모집게시판',),
              BottomNavigationBarItem(icon: Icon(Icons.account_circle), label : '마이페이지',),
            ],
            // 라벨 스타일
            showSelectedLabels: true,
            showUnselectedLabels: true,

            // bottom 영역 스타일 지정
            backgroundColor: const Color(0xffff9201),
            unselectedItemColor: Colors.white,
            selectedItemColor: Colors.white,

            // 디자인
            selectedIconTheme: IconThemeData(
              size: 27,
            ),
            unselectedIconTheme: IconThemeData(
              size: 27,
            ),

            selectedLabelStyle: TextStyle(fontSize: 14,),

          ),
        ),
      ),
    );

  }
  void onItemTap(int i){
    setState(() {
      index = i;
    });
  }
}

class User {
  final String region1;
  final String region2;
  final int env;

  User(this.region1, this.region2, this.env);
}

Widget _userContainer(String? region1, String? region2, String? env){
  return Container(
    alignment: Alignment.center,
    padding: EdgeInsets.all(10),
    child: Row(
      children: [
        Icon(Icons.person),
        SizedBox(width: 10,),
        Container(
          alignment: Alignment.center,
          width: 130,
          padding: EdgeInsets.all(3),
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(5),
            color: Colors.grey[300],
          ),
          child: Text('${region1}'),
        ),
        SizedBox(width: 8,),
        Container(
          alignment: Alignment.center,
          width: 60,
          padding: EdgeInsets.all(3),
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(5),
            color: Colors.grey[300],
          ),
          child: Text('${region2}'),
        ),
        SizedBox(width: 8,),
        Container(
          alignment: Alignment.center,
          width: 60,
          padding: EdgeInsets.all(3),
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(5),
            color: Colors.grey[300],
          ),
          child: Text('${env} MWh'),
        ),
      ],
    ),
  );
}


