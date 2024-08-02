import 'package:flutter/material.dart';
import 'package:geolocator/geolocator.dart';

class SolarEnv extends StatefulWidget {
  const SolarEnv({super.key});

  // 위치 정보에 대한 기능을 수행하는 메소드 생성
  void getLocation() async{
    await Geolocator.requestPermission();
    Position position = await Geolocator.getCurrentPosition(desiredAccuracy: LocationAccuracy.high);
    print(position);
  }

  @override
  State<SolarEnv> createState() => _SolarEnvState();
}

class _SolarEnvState extends State<SolarEnv> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      body: Stack(
        fit: StackFit.loose,
        children: [
          Positioned(
            child: Container(
              width: double.infinity,
              height: 250,
              decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(30),
                gradient: LinearGradient(
                    begin: const Alignment(0.0, -1.0),
                    end: const Alignment(0.0, 1.0),
                    colors: [Color(0xff008fff), Color(0xff40abff), Colors.white,]
                ),
                shape: BoxShape.rectangle,
              ),
              margin: EdgeInsets.all(5),
              child: Column(
                children: [
                  SizedBox(height: 20,),
                  Row(
                    children: [
                      SizedBox(width: 30,),
                      Text('30℃', style: TextStyle(fontSize: 38, color: Colors.white),),
                      SizedBox(width: 100,),
                      Column(
                        mainAxisAlignment: MainAxisAlignment.end,
                        children: [
                          Text('최저 : 25℃',style: TextStyle(fontSize: 20, color: Colors.white),),
                          Text('최고 : 30℃',style: TextStyle(fontSize: 20, color: Colors.white),),
                        ],
                      ),
                      // SizedBox(width: 10,),
                      Image.asset('image/sun3_remove.png', width: 80,height: 80,),
                    ],
                  ),
                  Row(
                    children: [
                      SizedBox(height: 5,width: 20,),
                      Text('광주광역시',style: TextStyle(fontSize: 20, color: Colors.white),
                      ),
                    ],
                  ),
                ],
              ),
            ),
          ),
          // -----------두번째 컨테이너---------------
          Positioned(
            top: 200,
            // left: 100,
            child: Container(
              width: 200,
              height: 100,
              padding: EdgeInsets.all(15),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(12),
                boxShadow: [
                  BoxShadow(
                    color : Colors.grey.withOpacity(0.5),
                    spreadRadius: 1.5,
                    blurRadius: 5,
                    offset: Offset(0,3),  // 그림자 위치 변경
                  ),
                ],
              ),
              child : Column(
                children: [
                  Text(
                    'SolQuiz 발전소',
                    style: TextStyle(
                      color: Color(0xFF1E1E1E),
                      fontSize: 16,
                      fontFamily: 'Inter',
                      fontWeight: FontWeight.w600,
                      height: 0.09,
                    ),
                  ),
                ],
              ),
            ),
          ),
          // Container(
          //   width: 200,
          //   height: 100,
          //   padding: EdgeInsets.all(15),
          //   decoration: BoxDecoration(
          //     color: Colors.white,
          //     borderRadius: BorderRadius.circular(12),
          //     boxShadow: [
          //       BoxShadow(
          //         color : Colors.grey.withOpacity(0.5),
          //         spreadRadius: 1.5,
          //         blurRadius: 5,
          //         offset: Offset(0,3),  // 그림자 위치 변경
          //       ),
          //     ],
          //   ),
          //   child : Column(
          //     children: [
          //       SizedBox(height: 8,),
          //       Text('[공지] 집에 가고 싶다', style: TextStyle(fontSize: 15, color: Color(0xff1e1e1e)),),
          //     ],
          //   ),
          // ),
        ],
      ),

    );
  }
}
